<?php

use App\Http\Controllers\Api\ApiAddonController;
use App\Http\Controllers\Api\ApiTestimonialController;
use App\Http\Controllers\Api\ApiFaqController;
use App\Http\Controllers\Api\ApiNewsController;
use App\Http\Controllers\Api\ApiLayananController;
use App\Http\Controllers\Api\ApiContactController;
use App\Http\Controllers\Api\ApiPricingController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\BantuanController;
use App\Http\Controllers\Api\BerandaController;
use App\Http\Controllers\Api\HargaController;
use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\SolusiController;
use App\Http\Controllers\Api\TentangKamiController;
use App\Http\Controllers\Api\USPController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\ApiPricing2Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function () {

    // Beranda
    Route::get('beranda', [BerandaController::class, 'index']);
    Route::get('tentang-kami', [TentangKamiController::class, 'index']);
    Route::get('solusi', [SolusiController::class, 'index']);
    Route::get('harga', [HargaController::class, 'index']);
    Route::get('artikel', [ArtikelController::class, 'index']);
    Route::get('outhor/{id}', [ArtikelController::class, 'outhor']);
    Route::get('all-category', [NewsCategoryController::class, 'getAll']);
    Route::get('detail-artikel/{slug}', [ArtikelController::class, 'show']);
    Route::get('bantuan', [BantuanController::class, 'index']);
    Route::get('usp', [USPController::class, 'index']);
    Route::get('detail-usp/{id}', [USPController::class, 'show']);
    // Pricing
    Route::get('pricing', [ApiPricingController::class, 'index']);
    Route::get('detail/pricing/{id}', [ApiPricingController::class, 'show']);

    // Add on
    Route::get('add-on', [ApiAddonController::class, 'index']);
    Route::get('detail/add-on/{id}', [ApiAddonController::class, 'show']);

    // Pricing New
    Route::get('division', [DivisionController::class, 'index']);
    Route::get('pricing_new', [ApiPricing2Controller::class, 'index']);
    Route::get('get-all-pricing', [ApiPricing2Controller::class, 'getAllPricing']);
});
