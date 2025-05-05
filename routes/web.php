<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CarpetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuoteController;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use App\Http\Controllers\MeasurementController;

Route::get('/',[AdminController::class,'home']);
Route::get('/home',[AdminController::class,'index'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Carpets routes
    Route::get('/carpets', [CarpetController::class, 'index'])->name('carpets.index');

    // Address routes
    Route::resource('addresses', AddressController::class);

    // Measurement routes
    Route::resource('measurements', MeasurementController::class);

    // Quotes routes
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('quotes.show');
    Route::get('/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('quotes.edit');
    Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('quotes.update');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');

Route::post('/quotes/{quote}/pay', [QuoteController::class, 'pay'])
    ->name('quotes.pay');
    
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        // Quotes routes
        Route::get('/quotes', [AdminController::class, 'quotes'])->name('admin.quotes');
        Route::get('/quotes/create', [AdminController::class, 'createQuote'])->name('admin.quotes.create');
        Route::post('/quotes', [AdminController::class, 'storeQuote'])->name('admin.quotes.store');
        Route::get('/quotes/{quote}', [AdminController::class, 'showQuote'])->name('admin.quotes.show');
        Route::get('/quotes/{quote}/edit', [AdminController::class, 'editQuote'])->name('admin.quotes.edit');
        Route::put('/quotes/{quote}', [AdminController::class, 'updateQuote'])->name('admin.quotes.update');
        Route::delete('/quotes/{quote}', [AdminController::class, 'destroyQuote'])->name('admin.quotes.destroy');
        Route::get('/user/{user}/quotes', [AdminController::class, 'userQuotes'])->name('admin.user.quotes');

        // Addresses routes
        Route::get('/addresses', [AdminController::class, 'addresses'])->name('admin.addresses');
        Route::get('/addresses/create', [AdminController::class, 'createAddress'])->name('admin.addresses.create');
        Route::post('/addresses', [AdminController::class, 'storeAddress'])->name('admin.addresses.store');
        Route::get('/addresses/{address}', [AdminController::class, 'showAddress'])->name('admin.addresses.show');
        Route::get('/addresses/{address}/edit', [AdminController::class, 'editAddress'])->name('admin.addresses.edit');
        Route::put('/addresses/{address}', [AdminController::class, 'updateAddress'])->name('admin.addresses.update');
        Route::delete('/addresses/{address}', [AdminController::class, 'destroyAddress'])->name('admin.addresses.destroy');

        // Measurements routes
        Route::get('/measurements', [AdminController::class, 'measurements'])->name('admin.measurements');
        Route::get('/measurements/create', [AdminController::class, 'createMeasurement'])->name('admin.measurements.create');
        Route::post('/measurements', [AdminController::class, 'storeMeasurement'])->name('admin.measurements.store');
        Route::get('/measurements/{measurement}', [AdminController::class, 'showMeasurement'])->name('admin.measurements.show');
        Route::get('/measurements/{measurement}/edit', [AdminController::class, 'editMeasurement'])->name('admin.measurements.edit');
        Route::put('/measurements/{measurement}', [AdminController::class, 'updateMeasurement'])->name('admin.measurements.update');
        Route::delete('/measurements/{measurement}', [AdminController::class, 'destroyMeasurement'])->name('admin.measurements.destroy');
    });

Route::post('/payment/handle/{quote}', [\App\Http\Controllers\PaymentController::class, 'handlePayment'])
    ->name('payment.handle');

Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])
    ->name('payment.success');

Route::get('/payment/cancel', [\App\Http\Controllers\PaymentController::class, 'cancel'])
    ->name('payment.cancel');
});

Route::post('/payment/handle/{quote}', [\App\Http\Controllers\PaymentController::class, 'handlePayment'])
    ->name('payment.handle');

Route::get('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])
    ->name('payment.success');

Route::get('/payment/cancel', [\App\Http\Controllers\PaymentController::class, 'cancel'])
    ->name('payment.cancel');
