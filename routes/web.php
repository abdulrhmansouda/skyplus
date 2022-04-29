<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BindingAppController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\RechargeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingOtherController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Point\ChangePasswordController as PointChangePasswordController;
use App\Http\Controllers\Point\ReportController as PointReportController;
use App\Http\Controllers\Point\SocialController;
use App\Http\Controllers\Point\SubscriberController as PointSubscriberController;
use App\Http\Controllers\Point\SupportController as PointSupportController;
// use App\Http\Controllers\Point\SupportController;
use App\Http\Controllers\SettingSocialController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {

    $date = Carbon::now();

    $date = new Carbon('1999-9-11');

    dd($date->addMonth());
});

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
            ->name('points.')
            ->group(function () {
                Route::get('/', [PointController::class, 'index'])->name('index');
                Route::post('/store', [PointController::class, 'store'])->name('store');
                Route::put('/update/{point}', [PointController::class, 'update'])->name('update');
                Route::delete('/destroy/{point}', [PointController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('/subscribers')
            ->name('subscribers.')
            ->group(function () {
                Route::get('/', [SubscriberController::class, 'index'])->name('index');
                Route::post('/store', [SubscriberController::class, 'store'])->name('store');
                Route::put('/update/{subscriber}', [SubscriberController::class, 'update'])->name('update');
                Route::delete('/destroy/{subscriber}', [SubscriberController::class, 'destroy'])->name('destroy');
                Route::get('/export', [SubscriberController::class, 'export'])->name('export');
                Route::post('/import', [SubscriberController::class, 'import'])->name('import');

                Route::middleware(['superadmin'])
                ->put('/charge/{subscriber}', [SubscriberController::class, 'charge'])->name('charge');


            });

        Route::prefix('/packages')
            ->name('packages.')
            ->group(function () {
                Route::get('/', [PackageController::class, 'index'])->name('index');
                Route::post('/store', [PackageController::class, 'store'])->name('store');
                Route::put('/update/{package}', [PackageController::class, 'update'])->name('update');
                Route::delete('/destroy/{package}', [PackageController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('/recharge')
            ->name('recharge.')
            ->group(function () {
                Route::get('/', [RechargeController::class, 'index'])->name('index');
                Route::put('/charge/{point}', [RechargeController::class, 'charge'])->name('charge');
            });

        Route::prefix('/admins')
            ->name('admins.')
            ->middleware(['superadmin'])
            ->group(function () {
                Route::get('/', [AdminController::class, 'index'])->name('index');
                Route::post('/store', [AdminController::class, 'store'])->name('store');
                Route::put('/update/{admin}', [AdminController::class, 'update'])->name('update');
                Route::delete('/destroy/{admin}', [AdminController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('/reports')
            ->name('reports.')
            ->group(function () {
                Route::get('/', [ReportController::class, 'index'])->name('index');
                Route::post('/export', [ReportController::class, 'admin_export'])->name('export');
            });

        Route::prefix('/support')
            ->name('support.')
            ->group(function () {
                Route::get('/', [SupportController::class, 'index'])->name('index');
                Route::post('/accept-request',[ SupportController::class , 'accept_request'])->name('accept_request');
                Route::post('/reject-request',[ SupportController::class , 'reject_request'])->name('reject_request');

            });


        Route::prefix('/sitting')
            ->name('setting.')
            ->group(function () {

                Route::prefix('/change-password')
                    ->name('change-password.')
                    ->group(function () {
                        Route::get('/', [ChangePasswordController::class, 'index'])->name('index');
                        Route::put('/update', [ChangePasswordController::class, 'update'])->name('update');
                    });

                Route::prefix('/social')
                    ->name('social.')
                    ->group(function () {
                        Route::get('/', [SettingSocialController::class, 'index'])->name('index');
                        Route::put('/update', [SettingSocialController::class, 'update'])->name('update');
                    });

                Route::prefix('/other-settings')
                    ->name('other.')
                    ->group(function () {
                        Route::get('/', [SettingOtherController::class, 'index'])->name('index');
                        Route::post('/update', [SettingOtherController::class, 'update_maximum_amount_of_borrowing'])->name('update');
                    });
            });
    });

Route::middleware(['auth', 'point'])
    ->prefix('/point')
    ->name('point.')
    ->group(function () {

        Route::prefix('/subscribers')
            ->name('subscribers.')
            ->group(function () {
                Route::get('/', [PointSubscriberController::class, 'index'])->name('index');
                Route::put('/charge/{subscriber}', [PointSubscriberController::class, 'charge'])->name('charge');
            });

            Route::prefix('/support')
            ->name('support.')
            ->group(function () {
                Route::get('/', [PointSupportController::class, 'index'])->name('index');
                Route::post('/support_request',[ PointSupportController::class, 'support_request'])->name('support_request');
            });

        Route::prefix('/reports')
            ->name('reports.')
            ->group(function () {
                Route::get('/', [PointReportController::class, 'index'])->name('index');
                Route::post('/export', [PointReportController::class, 'export'])->name('export');
            });

        Route::prefix('/social')
            ->name('social.')
            ->group(function () {
                Route::get('/', [SocialController::class, 'index'])->name('index');
            });

        Route::prefix('/sitting')
            ->name('setting.')
            ->group(function () {
                Route::prefix('/change-password')
                    ->name('change-password.')
                    ->group(function () {
                        Route::get('/', [PointChangePasswordController::class, 'index'])->name('index');
                        Route::put('/update', [PointChangePasswordController::class, 'update'])->name('update');
                    });
            });
    });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
