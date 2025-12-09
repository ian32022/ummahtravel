<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\PackageDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $bookings = Booking::with(['user', 'package', 'packageDate'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $bookings = $user->bookings()
                ->with(['package', 'packageDate'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'package_date_id' => 'required|exists:package_dates,id',
            'room_type' => 'required|in:double,triple,quad',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $package = Package::findOrFail($request->package_id);
        $packageDate = PackageDate::findOrFail($request->package_date_id);

        // Check availability
        if ($packageDate->available_slots <= 0) {
            return response()->json(['message' => 'No available slots for this date'], 400);
        }

        $totalPrice = $package->getPriceByRoomType($request->room_type);

        $booking = Booking::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'package_date_id' => $packageDate->id,
            'room_type' => $request->room_type,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking->load(['package', 'packageDate'])
        ], 201);
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'package', 'packageDate'])->findOrFail($id);
        
        // Authorization check
        if (Auth::user()->id !== $booking->user_id && !Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($booking);
    }

    public function updatePayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        if (!Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'payment_status' => 'required|in:unpaid,pending,paid,failed',
            'payment_method' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $booking->update([
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_status === 'paid' ? now() : null,
            'status' => $request->payment_status === 'paid' ? 'confirmed' : 'pending'
        ]);

        return response()->json([
            'message' => 'Payment status updated successfully',
            'booking' => $booking
        ]);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        
        if (!Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $booking = Booking::findOrFail($id);
        
        if (Auth::user()->id !== $booking->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $booking->update([
            'payment_proof' => $path,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Payment proof uploaded successfully',
            'booking' => $booking
        ]);
    }
}