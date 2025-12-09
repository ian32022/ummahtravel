protected $routeMiddleware = [
    // ... middleware lainnya
    'midtrans.signature' => \App\Http\Middleware\VerifyMidtransSignature::class,
      'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
Route::post('/api/midtrans/notification', [PaymentController::class, 'handleNotification'])
    ->middleware('midtrans.signature')
    ->name('api.midtrans.notification');