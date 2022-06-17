<?php

use App\Http\Controllers\Accountant;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Point;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::get('/getUpdateTelegram', [TelegramController::class, 'updatedActivity']);

Route::get('/', function () {
    return redirect(route('login'));
});

Route::middleware(['auth', 'admin'])
    ->prefix('/admin/dashboard')
    ->name('admin.')
    ->group(function () {
        Route::controller(Admin\HomeController::class)
            ->prefix('/home')
            ->group(function () {
                Route::get('/', 'index')->name('home');
            });

        Route::controller(Admin\PointController::class)
            ->prefix('/points')
            ->name('points.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{point}', 'update')->name('update');
                Route::delete('/destroy/{point}', 'destroy')->name('destroy');
            });

        Route::controller(Admin\SubscriberController::class)
            ->prefix('/subscribers')
            ->name('subscribers.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{subscriber}', 'update')->name('update');
                Route::delete('/destroy/{subscriber}', 'destroy')->name('destroy');
                Route::get('/export', 'export')->name('export');
                Route::post('/import', 'import')->name('import');

                Route::middleware(['superadmin'])
                    ->put('/charge/{subscriber}', 'charge')->name('charge');
            });

        Route::controller(Admin\PackageController::class)
            ->prefix('/packages')
            ->name('packages.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{package}', 'update')->name('update');
                Route::delete('/destroy/{package}', 'destroy')->name('destroy');
            });

        Route::controller(Admin\RechargeController::class)
            ->prefix('/recharge')
            ->name('recharge.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/charge/{point}', 'charge')->name('charge');
            });

        Route::controller(Admin\AdminController::class)
            ->prefix('/admins')
            ->name('admins.')
            ->middleware(['superadmin'])
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{admin}', 'update')->name('update');
                Route::delete('/destroy/{admin}', 'destroy')->name('destroy');
            });

        Route::controller(Admin\ReportController::class)
            ->prefix('/reports')
            ->name('reports.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/export', 'admin_export')->name('export');
            });

        Route::controller(Admin\SupportController::class)
            ->prefix('/support')
            ->name('support.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/accept-request/{request}', 'acceptRequest')->name('acceptRequest');
                Route::post('/reject-request/{request}', 'rejectRequest')->name('rejectRequest');
            });

        Route::controller(Admin\SupportNewSubscriberController::class)
            ->prefix('/support-new-subscriber')
            ->name('supportNewSubscriber.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/accept-request/{request}', 'acceptRequest')->name('acceptRequest');
                Route::post('/reject-request/{request}', 'rejectRequest')->name('rejectRequest');
            });


        Route::prefix('/sitting')
            ->name('setting.')
            ->group(function () {

                Route::controller(Admin\BindingTelegramController::class)
                    ->prefix('/binding-telegram')
                    ->middleware(['superadmin'])
                    ->name('binding-telegram.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::put('/charge-update', 'chargeUpdate')->name('charge-update');
                        Route::put('/maintenance-update', 'maintenanceUpdate')->name('maintenance-update');
                    });

                Route::controller(Admin\ChangePasswordController::class)
                    ->prefix('/change-password')
                    ->name('change-password.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::put('/update', 'update')->name('update');
                    });

                Route::controller(Admin\SettingSocialController::class)
                    ->prefix('/social')
                    ->name('social.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::put('/update', 'update')->name('update');
                    });

                Route::controller(Admin\SettingOtherController::class)
                    ->prefix('/other-settings')
                    ->name('other.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::post('/update', 'update_maximum_amount_of_borrowing')->name('update');
                    });
            });
    });

Route::middleware(['auth', 'point'])
    ->prefix('/point')
    ->name('point.')
    ->group(function () {

        Route::controller(Point\SubscriberController::class)
            ->prefix('/subscribers')
            ->name('subscribers.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/charge/{subscriber}', 'charge')->name('charge');
                Route::post('/uncharge/{subscriber}', 'uncharge')->name('uncharge');
                Route::post('/switch-package-and-charge-request/{subscriber}', 'switchPackageAndChargeRequest')->name('switchPackageAndChargeRequest');
                Route::post('/maintenance/{subscriber}', 'maintenance')->name('maintenance');
                Route::post('/transfer/{subscriber}', 'transfer')->name('transfer');
            });

        Route::controller(Point\SupportController::class)
            ->prefix('/support')
            ->name('support.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/new-subscriber-request', 'newSubscriberRequest')->name('newSubscriberRequest');
                Route::post('/switch-company-request', 'switchCompanyRequest')->name('switchCompanyRequest');
            });

        Route::controller(Point\ReportController::class)
            ->prefix('/reports')
            ->name('reports.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/export', 'export')->name('export');
            });

        Route::controller(Point\SocialController::class)
            ->prefix('/social')
            ->name('social.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });

        Route::controller(Point\ChangePasswordController::class)
            ->prefix('/sitting')
            ->name('setting.')
            ->group(function () {
                Route::prefix('/change-password')
                    ->name('change-password.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::put('/update', 'update')->name('update');
                    });
            });
    });

Route::middleware(['auth', 'accountant'])
    ->prefix('/accountant')
    ->name('accountant.')
    ->group(function () {

        Route::controller(Accountant\HomeController::class)
            ->group(function () {
                Route::get('/home', 'index')->name('home');
            });

        Route::controller(Accountant\BoxCashController::class)
            ->prefix('/box-cash')
            ->name('box-cash.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
            });

        Route::controller(Accountant\BoxBankController::class)
            ->prefix('/box-bank')
            ->name('box-bank.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });

        Route::prefix('/sitting')
            ->name('setting.')
            ->group(function () {
                Route::controller(Accountant\ChangePasswordController::class)
                    ->prefix('/change-password')
                    ->name('change-password.')
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::put('/update', 'update')->name('update');
                    });
            });
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
