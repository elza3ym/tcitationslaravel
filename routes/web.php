<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\AttorneyTicketController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyTicketController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverTicketController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerTicketController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DriverController as APIDriverController;
use App\Http\Controllers\Api\CompanyController as APICompanyController;
use App\Http\Controllers\Api\AttorneyController as APIAttorneyController;
use App\Http\Controllers\Api\TicketAttachmentController as APITicketAttachmentController;
use App\Http\Controllers\Api\TicketNoteController as APITicketNoteController;

//DocumentViewer Library
Route::any('ViewerJS/{all?}', function(){

    return \Illuminate\Support\Facades\View::make('ViewerJS.index');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Admin Routes.
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        // Dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // tickets.
        Route::resource('tickets', AdminTicketController::class);
        Route::resource('admins', AdminController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('managers', ManagerController::class);
        Route::resource('attorneys', AttorneyController::class);
        Route::resource('drivers', DriverController::class);
    });

    // Company Routes.
    Route::group(['middleware' => 'role:company', 'prefix' => 'company', 'as' => 'company.'], function () {
        Route::resource('tickets', CompanyTicketController::class);
        Route::resource('companies', CompanyController::class);
    });

    // Manager Routes
    Route::group(['middleware' => 'role:manager', 'prefix' => 'manager', 'as' => 'manager.'], function () {
        Route::resource('tickets', ManagerTicketController::class);
    });

    // Attorney Routes
    Route::group(['middleware' => 'role:attorney', 'prefix' => 'attorney', 'as' => 'attorney.'], function () {
        Route::resource('tickets', AttorneyTicketController::class);
    });

    // Driver Routes
    Route::group(['middleware' => 'role:driver', 'prefix' => 'driver', 'as' => 'driver.'], function () {
        Route::resource('tickets', DriverTicketController::class);
    });
});








// API Routes. TODO: Move to api.php

Route::group(['middleware' => 'auth', 'prefix' => 'api', 'as' => 'api.'], function () {
    Route::get('drivers', [APIDriverController::class, 'index'])->name('driver.index');
    Route::get('companies', [APICompanyController::class, 'index'])->name('company.index');
    Route::get('attorneys', [APIAttorneyController::class, 'index'])->name('attorney.index')->middleware('auth');
    Route::post('ticket/{ticket}/attach', [APITicketAttachmentController::class, 'store'])->name('tickets-attach.store')->middleware('auth');
    Route::post('ticket/{ticket}/note', [APITicketNoteController::class, 'store'])->name('tickets-note.store')->middleware('auth');

//    Route::post('')
});















Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
