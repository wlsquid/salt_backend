<?php

use App\Http\Controllers\AddressListsController;
use App\Http\Controllers\AddressDataController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//define auth routes
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
// addressList routes
Route::group([
    'prefix' => '/addressList',
    'as' => 'addressList.',
    'middleware' => 'auth:sanctum'
  ], function () {
      Route::post('/add', [AddressListsController::class, 'createAddressList'])->name('add');
      //TODO: make this go off {$id} not the request body
      Route::post('/delete', [AddressListsController::class, 'archiveAddressList'])->name('delete');
      Route::get('/all', [AddressListsController::class, 'getAddressLists'])->name('all');
});

// addressData routes
Route::group([
    'prefix' => '/addressData',
    'as' => 'addressData.',
    'middleware' => 'auth:sanctum'
  ], function () {
      Route::post('/uploadToCSV', [AddressDataController::class, 'importAddressDataFromCSV'])->name('add');
      
      Route::post('/update/{dataId}', [AddressDataController::class, 'updateAddressData'])->name('update');
      Route::get('/{listId}', [AddressDataController::class, 'getAddressDataForList'])->name('all');
});

// addressData routes
Route::group([
    'prefix' => '/addressData',
    'as' => 'addressData.',
    'middleware' => 'auth:sanctum'
  ], function () {
      Route::post('/uploadToCSV', [AddressDataController::class, 'importAddressDataFromCSV'])->name('add');
      
      Route::post('/update/{dataId}', [AddressDataController::class, 'updateAddressData'])->name('update');
      Route::get('/{listId}', [AddressDataController::class, 'getAddressDataForList'])->name('all');
});