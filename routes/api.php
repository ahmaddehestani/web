<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CycleController;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\PlanController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/confirmOpt',[AuthController::class,'confirmOtp']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/forgetPassword',[AuthController::class,'forgetPassword']);
Route::post('/setPassword',[AuthController::class,'setPassword'])->middleware('auth:api');
Route::apiresource('ticket', TicketController::class)->parameter('ticket','ticket:key');
Route::get('ticket/{ticket:key}/toggle', [TicketController::class,'toggleStatus']);
Route::apiresource('message', MessageController::class)->parameter('message','message:uuid');
Route::apiresource('category', CategoryController::class)->parameter('category', 'category:uuid');
Route::apiresource('user', UserController::class)->parameter('user', 'user:uuid');
Route::apiresource('product', ProductController::class)->parameter('product', 'product:uuid');
Route::apiresource('plan', PlanController::class)->parameter('plan', 'plan:uuid');
Route::apiresource('cycle', CycleController::class)->parameter('cycle', 'cycle:uuid');
Route::apiresource('service', ServiceController::class)->parameter('service', 'service:uuid');
Route::apiresource('video', ServiceController::class)->parameter('video', 'video:uuid');
Route::apiresource('role', RoleController::class);


