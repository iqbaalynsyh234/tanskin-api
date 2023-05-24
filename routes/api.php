<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XenditAuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\XenditCallbackController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EwalletTransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login and Logout Routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout']);

// ** Transaction ** //
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::put('/transactions/{id}', [TransactionController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

/**payment */
Route::get('payments', [PaymentController::class, 'index']);
Route::post('payments/add', [PaymentController::class, 'store']);
Route::get('payments/{id}', [PaymentController::class, 'show']);
Route::put('payments/{id}', [PaymentController::class, 'update']);
Route::delete('payments/{id}', [PaymentController::class, 'destroy']);

 // ** Ewallets **//
 Route::get('ewallet-transactions', [EwalletTransactionController::class, 'index']);
 Route::post('ewallet-transactions/add', [EwalletTransactionController::class, 'store']);
 Route::get('ewallet-transactions/{id}', [EwalletTransactionController::class, 'show']);
 Route::put('ewallet-transactions/{id}', [EwalletTransactionController::class, 'update']);
 Route::delete('ewallet-transactions/{id}', [EwalletTransactionController::class, 'destroy']);

// Route::middleware('auth:sanctum')->group(function () {


// });

// Route Auth **//
Route::group(['middleware' => 'auth:xendit'], function () {
    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
    Route::post('/invoices', [InvoiceController::class, 'store']);
    Route::put('/invoices/{id}', [InvoiceController::class, 'update']);
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy']);
});

