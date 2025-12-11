<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
            ->with(['dates' => function($query) {
                $query->where('is_available', true)
                    ->where('available_slots', '>', 0)
                    ->orderBy('departure_date');
            }])
            ->get();

        return response()->json($packages);
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('is_active', true)
            ->with(['dates' => function($query) {
                $query->where('is_available', true)
                    ->where('available_slots', '>', 0)
                    ->orderBy('departure_date');
            }])
            ->firstOrFail();

        return response()->json($package);
    }

    // Admin methods
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration_days' => 'required|integer|min:1',
            'type' => 'required|in:reguler,plus_dubai,plus_turki,plus_jepang',
            'double_price' => 'required|numeric|min:0',
            'triple_price' => 'required|numeric|min:0',
            'quad_price' => 'required|numeric|min:0',
            'airline' => 'required|string|max:255',
            'hotel_madinah' => 'required|string|max:255',
            'hotel_makkah' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $package = Package::create(array_merge(
            $request->all(),
            ['slug' => \Str::slug($request->name)]
        ));

        return response()->json([
            'message' => 'Package created successfully',
            'package' => $package
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'duration_days' => 'sometimes|required|integer|min:1',
            'type' => 'sometimes|required|in:reguler,plus_dubai,plus_turki,plus_jepang',
            'double_price' => 'sometimes|required|numeric|min:0',
            'triple_price' => 'sometimes|required|numeric|min:0',
            'quad_price' => 'sometimes|required|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $package->update($request->all());

        return response()->json([
            'message' => 'Package updated successfully',
            'package' => $package
        ]);
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return response()->json(['message' => 'Package deleted successfully']);
    }

    public function addDate(Request $request, $packageId)
    {
        $package = Package::findOrFail($packageId);

        $validator = Validator::make($request->all(), [
            'departure_date' => 'required|date|after:today',
            'display_date' => 'required|string',
            'available_slots' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $date = PackageDate::create([
            'package_id' => $package->id,
            'departure_date' => $request->departure_date,
            'display_date' => $request->display_date,
            'available_slots' => $request->available_slots,
            'is_available' => true
        ]);

        return response()->json([
            'message' => 'Date added successfully',
            'date' => $date
        ], 201);
    }
}