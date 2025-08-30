<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoleController;


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('clients', ClientController::class);
    // Removed notification routes
    Route::resource('documents', DocumentController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::post('/documents/store2', [DocumentController::class, 'store2'])->name('documents.store2');
    Route::post('/activites/{activite}/documents', [DocumentController::class, 'storeForActivity'])->name('documents.storeForActivity');
    Route::resource('paiements', PaiementController::class);
    Route::resource('depenses', DepenseController::class);
    Route::post('/activites/{activite}/depenses', [DepenseController::class, 'storeForActivity'])->name('depenses.storeForActivity');
    Route::resource('activites', ActiviteController::class);
    Route::get('realisations', [ActiviteController::class, 'indexRealisations'])->name('realisations.index');
    Route::get('etudes', [ActiviteController::class, 'indexEtudes'])->name('etudes.index');
    Route::get('expertises', [ActiviteController::class, 'indexExpertises'])->name('expertises.index');
    Route::get('autorisations', [ActiviteController::class, 'indexAutorisations'])->name('autorisations.index');
    Route::resource('projets', ProjetController::class);
    Route::resource('users', UserController::class);
    Route::resource('conversations', ConversationController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/conversations/start/{user}', [ConversationController::class, 'startConversation'])->name('conversations.start');
    Route::get('/conversations/{conversation}/messages', [ConversationController::class, 'getMessages'])->name('conversations.messages');
    Route::get('/conversations/find-or-create/{user}', [ConversationController::class, 'findOrCreateConversation'])->name('conversations.findOrCreate');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    // Add other resources here in the future
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');

    // Roles and Permissions
    Route::resource('/settings/roles', RoleController::class)->except(['show']);
    

    
});