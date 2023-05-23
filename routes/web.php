<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\User as UserController;
use App\Http\Controllers\Thread as ThreadController;
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

Route::get('/services/boardlist', [BoardController::class, 'serveBoardListPage']);

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

Route::get('/board/{boardUri}/{threadPseudoId}', [ThreadController::class, 'serveThreadIndex']);

    //////////////////////////////////////////////////////////////
    ///////////////////   POST METHODS    ////////////////////////
    //////////////////////////////////////////////////////////////

Route::post('/forms/login/', [UserController::class, 'login']);

Route::post('/forms/logout/', [UserController::class, 'logOut']);

Route::post('/forms/signup/', [UserController::class, 'signUp']);

Route::post('/forms/newthread/', [ThreadController::class, 'makeThread']);

Route::post('/forms/newreply/', [ReplyController::class, 'makeReply']);

Route::post('/forms/deleteboard/{uri}', [BoardController::class, 'deleteBoard']);

Route::post('/forms/globalManage/setGeneralConfig/', [GlobalManageController::class, 'setKurenaiGeneralConfig']);

Route::post('/forms/globalManage/setPostConfig/', [GlobalManageController::class, 'setKurenaiPostConfig']);

Route::post('/forms/globalManage/setBoardConfig/', [GlobalManageController::class, 'setKurenaiBoardConfig']);

    //////////////////////////////////////////////////////////////
    ///////////////////   OTHER METHODS    ///////////////////////
    //////////////////////////////////////////////////////////////

Route::redirect('/{catchall}', '/error/404')->where('catchall', '.*');
