<?php

use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\ReportController;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//http://localhost:8000/api/points?name=abd
Route::get('/points',[PointController::class,'searchNameApi']);

//http://localhost:8000/api/package?id=1
Route::get('/package',[PackageController::class,'pricePackageApi']);
