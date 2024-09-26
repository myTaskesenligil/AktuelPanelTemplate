<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\AuthController;
use App\Http\Controllers\Panel\MenuController;
use App\Http\Controllers\Panel\ModuleSettings;
use App\Http\Middleware\CheckModulePermission;
use App\Http\Controllers\Panel\PanelPageController;
use App\Http\Controllers\Panel\SiteSettingController;

Route::get('/', [PanelPageController::class, 'index'])->name('index');
Route::post('/', [PanelPageController::class, 'index'])->name('index');

Route::get('/create-password/{id}', [PanelPageController::class, 'createPassword'])->name('create-password');
Route::post('/create-password/save', [PanelPageController::class, 'saveNewPassword'])->name('save-password');
Route::get('/forgot-password', [PanelPageController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [PanelPageController::class, 'resentPassword'])->name('forgot-password');

Route::middleware(['auth', 'check.module.permission'])->group(function () {
    // Middleware grubuna dahil edilen rotalar
    Route::get('/logout', [PanelPageController::class, 'logout'])->name('logout');

    Route::get('/module-settings', [ModuleSettings::class, 'getModules'])->name('module-settings');
    Route::post('/module-settings/add/parent', [ModuleSettings::class, 'addParentModule'])->name('module.add.parent');
    Route::post('/module-settings/add/child', [ModuleSettings::class, 'addChildModule'])->name('module.add.child');
    Route::post('/module-settings/add/group', [ModuleSettings::class, 'addGroup'])->name('module.add.group');
    Route::post('/module-settings/delete', [ModuleSettings::class, 'deleteModule'])->name('module.delete');
    Route::post('/module-settings/switch', [ModuleSettings::class, 'switchData'])->name('module.switch');

    Route::get('/logs', [\App\Http\Controllers\Panel\LogsController::class, 'index'])->name('logs');
});
