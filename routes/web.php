<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GlobalManageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Keep in mind that, for every http request, these routes will be scanned 
| from top to bottom and the first matching route will be called. Keep
| the most specific, least dynamic routes at the top.
|
| For security reasons, always prefix the first param in the url.
|
*/

    /////////////////////////////////////////////////////////////
    ///////////////////   GET METHODS    ////////////////////////
    /////////////////////////////////////////////////////////////

Route::get('/', [IndexController::class, 'serveIndex']);

Route::get('/error/{errorName}', [ErrorController::class, 'serveErrorPage']);

Route::get('/services/login', [UserController::class, 'serveLoginPage']);

Route::get('/services/signup', [UserController::class, 'serveSignUpPage']);

Route::get('/services/createboard', [BoardController::class, 'serveCreateBoardPage']);

// Route::get('/manage/local/{boardUri}/dangerzone', [BoardController::class, 'serveLocalBoardManagementPageDangerZone']);

// Route::get('/manage/local/{boardUri}', [BoardController::class, 'serveLocalBoardManagementPage']);

// for post previews, ban-check, etc.
Route::get('/services/{service}', [PublicServicesController::class, 'servePublicService']);

// pages with simple text info (faq, rules, etc). These will be stored in a database
Route::get('/info/{uri}', [InfoPageController::class, 'serveInfoPage']);

Route::get('/global/manage/config', [GlobalManageController::class, 'serveGlobalManagementConfigPage']);

Route::get('/global/manage', [GlobalManageController::class, 'serveGlobalManagementPage']);

Route::get('/board/{boardUri}/manage/dangerzone', [BoardController::class, 'serveLocalBoardManagementPageDangerZone']);

Route::get('/board/{boardUri}/manage', [BoardController::class, 'serveLocalBoardManagementPage']);

Route::get('/board/{boardUri}', [BoardController::class, 'serveBoard']);

Route::get('/board/{boardUri}/{threadId}', [ThreadController::class, 'serveThread']);

Route::redirect('/{catchall}', '/error/404')->where('catchall', '.*'); // no idea if this will work

// 404, if all routes above didn't match the request's desired resource
// Route::get('/{catchall}', [ErrorController::class, 'serveNotFoundPage'])->where('catchall', '.*');

    //////////////////////////////////////////////////////////////
    ///////////////////   POST METHODS    ////////////////////////
    //////////////////////////////////////////////////////////////

Route::post('/forms/deleteboard/{uri}', [BoardController::class, 'deleteBoard']);