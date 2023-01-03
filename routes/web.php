<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BoardController;

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

    /////////////////////////////////////////////////////////////
    ///////////////////   GET METHODS    ////////////////////////
    /////////////////////////////////////////////////////////////

Route::get('/', [IndexController::class, 'serveIndex']);

Route::get('/{boardUri}', [BoardController::class, 'serveBoard']);

Route::get('/{boardUri}/{threadId}', [ThreadController::class, 'serveThread']);

Route::get('/manage/global/{service?}',
           [GlobalManagementController::class, 'serveGlobalManagementServices']);

// only for the board's BO, and the admin
Route::get('/manage/{boardUri}/{managementService?}', 
           [BoardManagementController::class, 'serveBoardManagementServices']);

// for post previews, ban-check, etc.
Route::get('/services/{service}', [PublicServicesController::class, 'servePublicService']);


// pages with simple text info (faq, rules, etc). These will be stored in a database
Route::get('/info/{uri}', [InfoPageController::class, 'serveInfoPage']);

    //////////////////////////////////////////////////////////////
    ///////////////////   POST METHODS    ////////////////////////
    //////////////////////////////////////////////////////////////

Route::post('/forms/deleteboard', [BoardController::class, 'deleteBoard']);