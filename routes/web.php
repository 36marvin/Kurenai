<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [IndexController::class, 'serverIndex']);

Route::get('/{boardUri}', [BoardController::class, 'serverBoard']);

Route::get('/{boardUri}/{threadId}', [ThreadController::class, 'serveThread']);

Route::get('/manage/global/{service?}',
           [GlobalManagementController::class, 'serveGlobalManagementServices']);

// only for the board's BO, and the admin
Route::get('/manage/{boardUri}/{managementService?}', 
           [BoardManagementController::class, 'serveBoardManagementServices']);

// for post previews, ban-check, etc.
Route::get('/services/{service}', [PublicServicesController::class, 'returnPublicService']);