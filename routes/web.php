<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])
    ->prefix('/admin/dashboard')
    ->name('admin.')
    ->group(function () {
        Route::prefix('/home')
            ->group(function () {
                Route::get('/', function () {
                    return view('admin.pages.home');
                })->name('home');
            });

        Route::prefix('/points')
            ->group(function () {
                Route::get('/', function () {
                    return view('admin.pages.points');
                })->name('points');
            });

        Route::prefix('/subscribers')
            ->group(function () {
                Route::get('/', function () {
                    return view('admin.pages.subscribers');
                })->name('subscribers');    
            });

            Route::prefix('/packages')
            ->group(function () {
                Route::get('/', function () {
                    return view('admin.pages.packages');
                })->name('packages');    
            });
    });

Route::middleware(['auth', 'point'])->group(function () {
    Route::get('/welcome1', function () {
        return 'user';
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
