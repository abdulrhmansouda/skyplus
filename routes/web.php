<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\SubscriberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware(['auth', 'admin'])
    ->prefix('/admin/dashboard')
    ->name('admin.')
    ->group(function () {
        Route::prefix('/home')
            ->group(function () {
                Route::get('/', [HomeController::class, 'index'])->name('home');
            });

        Route::prefix('/points')
            ->group(function () {
                Route::get('/', [PointController::class, 'index'])->name('points');
                Route::post('/store', [PointController::class, 'store'])->name('points.store');
                Route::delete('/destroy/{point}', [PointController::class, 'destroy'])->name('points.destroy');
            });

        Route::prefix('/subscribers')
            ->group(function () {
                Route::get('/', [SubscriberController::class, 'index'])->name('subscribers');
            });

        Route::prefix('/packages')
            ->group(function () {
                Route::get('/', [PackageController::class, 'index'])->name('packages');
            });
    });

Route::middleware(['auth', 'point'])
    ->prefix('/point')
    ->name('point.')
    ->group(function () {
        Route::prefix('/home')
            ->group(function () {
                Route::get('/',function(){
                    return 'point';
                })->name('home');
            });
    });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
