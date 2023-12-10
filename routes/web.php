<?php

use App\Http\Controllers\Web\CampaignController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[CampaignController::class, 'create'])->name('campaign.create');
Route::post('/campaign',[CampaignController::class, 'store'])->name('campaign.store');
