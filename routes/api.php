<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'neaith', 'as' => 'api.'], function () {
//    Route::get('drivers', [APIDriverController::class, 'index'])->name('driver.index');
//    Route::get('companies', [APICompanyController::class, 'index'])->name('company.index');
//    Route::get('attorneys', [APIAttorneyController::class, 'index'])->name('attorney.index')->middleware('auth');
});
