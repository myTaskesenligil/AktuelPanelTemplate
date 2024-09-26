<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SitePageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SitePageController::class, 'index'])->name('home');

Route::prefix('panel')->group(function () {
    Route::middleware('web')->group(base_path('routes/panel.php'));
});
