<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/packages', [PackageController::class, 'index']);
Route::get('/packages/{slug}', [PackageController::class, 'show']);
Route::post('/contact', [ContactController::class, 'store']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // User bookings
    Route::apiResource('bookings', BookingController::class)->except(['update', 'destroy']);
    Route::post('/bookings/{id}/upload-payment', [BookingController::class, 'uploadPaymentProof']);
    
    // User profile update
    Route::put('/profile', function (Request $request) {
        $user = $request->user();
        $user->update($request->all());
        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    });

    // Admin routes
    Route::middleware('admin')->group(function () {
        // Package management
        Route::apiResource('admin/packages', PackageController::class)->except(['index', 'show']);
        Route::post('/admin/packages/{packageId}/dates', [PackageController::class, 'addDate']);
        
        // Booking management
        Route::put('/admin/bookings/{id}/payment', [BookingController::class, 'updatePayment']);
        Route::delete('/admin/bookings/{id}', [BookingController::class, 'destroy']);
        
        // Contact management
        Route::apiResource('admin/contacts', ContactController::class)->only(['index', 'update', 'destroy']);
        Route::put('/admin/contacts/{id}/status', [ContactController::class, 'updateStatus']);
        
        // Dashboard statistics
        Route::get('/admin/dashboard/stats', function () {
            $totalUsers = \App\Models\User::count();
            $totalPackages = \App\Models\Package::count();
            $totalBookings = \App\Models\Booking::count();
            $pendingPayments = \App\Models\Booking::where('payment_status', 'pending')->count();
            
            return response()->json([
                'total_users' => $totalUsers,
                'total_packages' => $totalPackages,
                'total_bookings' => $totalBookings,
                'pending_payments' => $pendingPayments,
                'bookings_by_package' => \App\Models\Booking::groupBy('package_id')
                    ->selectRaw('package_id, count(*) as total')
                    ->with('package')
                    ->get()
            ]);
        });
    });
});