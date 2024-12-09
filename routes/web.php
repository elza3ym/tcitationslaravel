<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\AttorneyTicketController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverTicketController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ManagerTicketController;
use App\Http\Controllers\MessageReadController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController as APIUserController;
use App\Http\Controllers\Api\DriverController as APIDriverController;
use App\Http\Controllers\Api\CompanyController as APICompanyController;
use App\Http\Controllers\Api\AttorneyController as APIAttorneyController;
use App\Http\Controllers\Api\TicketAttachmentController as APITicketAttachmentController;
use App\Http\Controllers\Api\TicketNoteController as APITicketNoteController;

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReadController;

Route::post('/broadcasting/custom', function (\Illuminate\Http\Request $request) {
    // Add custom logic here before the default broadcasting auth
    if (!$request->user()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    return \Illuminate\Support\Facades\Broadcast::auth($request);
})->middleware(['auth']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });

    // Messagin.
    Route::get('messaging', [ConversationController::class, 'mainIndex'])->name('messaging.index');
    Route::get('messaging/{currentConversation}', [ConversationController::class, 'mainShow'])->name('messaging.show');
    Route::post('messaging/{currentConversation}/markAllAsRead', [MessageController::class, 'markAllAsRead'])->name('messaging.markAllAsRead');
    Route::post('messaging/{message}/read', [MessageController::class, 'markAsRead'])->name('messaging.markAsRead');
    Route::post('/conversations/{conversation}/add-user', [ConversationController::class, 'addUser'])->name('conversation.addUser');
    Route::delete('/conversations/{conversation}/remove-user/{user}', [ConversationController::class, 'removeUser'])->name('conversation.removeUser');

    // Mark all notifications as read
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

    // Mark a single notification as read
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');



    Route::get('/dashboard', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->hasRole('admin')) {
            return redirect(\route('admin.dashboard'));
        } else if ($user->hasRole('manager')) {
            return redirect(\route('manager.dashboard'));
        } else if ($user->hasRole('attorney')) {
            return redirect(\route('attorney.dashboard'));
        } else if ($user->hasRole('driver')) {
            return redirect(\route('driver.dashboard'));
        }
        abort(403);
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('support', [SupportController::class, 'index'])->name('support.index');
    Route::post('support', [SupportController::class, 'store'])->name('support.store');

    // Admin Routes.
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        // Dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // tickets.
        Route::post('tickets/bulk', [AdminTicketController::class, 'bulkUpdate'])->name('tickets.bulkUpdate');
        Route::get('tickets/export', [AdminTicketController::class, 'export'])->name('tickets.export');
        Route::get('tickets/archive', [AdminTicketController::class, 'archive'])->name('tickets.archive');
        Route::post('tickets/{ticket}/restore', [AdminTicketController::class, 'restore'])->name('tickets.restore');
        Route::resource('tickets', AdminTicketController::class);
        Route::resource('admins', AdminController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('managers', ManagerController::class);
        Route::resource('attorneys', AttorneyController::class);
        Route::resource('drivers', DriverController::class);

        Route::get('logs', [LogController::class, 'index'])->name('logs.index');
    });

    // Manager Routes
    Route::group(['middleware' => 'role:manager', 'prefix' => 'manager', 'as' => 'manager.'], function () {
        Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');
        Route::get('tickets/export', [ManagerTicketController::class, 'export'])->name('tickets.export');

        Route::resource('tickets', ManagerTicketController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('managers', ManagerController::class);
        Route::resource('drivers', DriverController::class);

    });

    // Attorney Routes
    Route::group(['middleware' => 'role:attorney', 'prefix' => 'attorney', 'as' => 'attorney.'], function () {
        Route::get('dashboard', [AttorneyController::class, 'dashboard'])->name('dashboard');
        Route::get('tickets/export', [AttorneyTicketController::class, 'export'])->name('tickets.export');
        Route::resource('tickets', AttorneyTicketController::class);
        Route::resource('drivers', DriverController::class);

    });

    // Driver Routes
    Route::group(['middleware' => 'role:driver', 'prefix' => 'driver', 'as' => 'driver.'], function () {
        Route::get('tickets/export', [DriverTicketController::class, 'export'])->name('tickets.export');
        Route::get('dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
        Route::resource('tickets', DriverTicketController::class);
    });
});








// API Routes. TODO: Move to api.php

Route::group(['middleware' => 'auth', 'prefix' => 'api', 'as' => 'api.'], function () {
    Route::get('users/exclude/{conversation?}', [APIUserController::class, 'exclude'])->name('users.exclude');
    Route::get('drivers', [APIDriverController::class, 'index'])->name('driver.index');
    Route::get('companies', [APICompanyController::class, 'index'])->name('company.index');
    Route::get('attorneys', [APIAttorneyController::class, 'index'])->name('attorney.index')->middleware('auth');
    Route::post('ticket/{ticket}/attach', [APITicketAttachmentController::class, 'store'])->name('tickets-attach.store')->middleware('auth');
    Route::post('ticket/{ticket}/note', [APITicketNoteController::class, 'store'])->name('tickets-note.store')->middleware('auth');

    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');
    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store']);
    Route::post('/messages/{message}/read', [ReadController::class, 'store']);
    Route::get('/messages/{message}/reads', [ReadController::class, 'getMessageReads']);

//    Route::post('')
});











Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
