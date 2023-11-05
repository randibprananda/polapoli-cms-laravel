<?php

use App\Http\Controllers\AddOnController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CompanyHistoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimRelawanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\USPController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\DivisionController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', function () {
    return redirect('/dashboard');
});

//######################## AUTH ########################

// Auth has been handled by Auth::routes(); above

//######################## DASHBOARD ########################

Route::group(['prefix' => 'dashboard', "middleware" => "auth"], function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/tim-relawan', [TimRelawanController::class, 'index']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);

    Route::get('/withdrawal', [WithdrawalController::class, 'index']);
    Route::post('/withdrawal-status/{id}', [WithdrawalController::class, 'status'])->name("dashboard.withdrawal.status");

    Route::get('/layanan', [LayananController::class, "index"])->name("dashboard.layanan.index");
    Route::put('/layanan/{id}/update', [LayananController::class, "update"])->name("dashboard.layanan.update");
    Route::delete('/layanan/{id}/destroy', [LayananController::class, "destroy"])->name("dashboard.layanan.destroy");
    Route::get('/layanan/{id}', [LayananController::class, "show"])->name("dashboard.layanan.show");
    Route::post('/layanan', [LayananController::class, "store"])->name("dashboard.layanan.store");

    Route::get('/solusi', [SolusiController::class, "index"])->name("dashboard.solusi.index");
    Route::put('/solusi/{id}/update', [SolusiController::class, "update"])->name("dashboard.solusi.update");
    Route::delete('/solusi/{id}/destroy', [SolusiController::class, "destroy"])->name("dashboard.solusi.destroy");
    Route::get('/solusi/{id}', [SolusiController::class, "show"])->name("dashboard.solusi.show");
    Route::post('/solusi', [SolusiController::class, "store"])->name("dashboard.solusi.store");

    Route::get('/client', [ClientController::class, "index"])->name("dashboard.client.index");
    Route::put('/client/{id}/update', [ClientController::class, "update"])->name("dashboard.client.update");
    Route::delete('/client/{id}/destroy', [ClientController::class, "destroy"])->name("dashboard.client.destroy");
    Route::get('/client/{id}', [ClientController::class, "show"])->name("dashboard.client.show");
    Route::post('/client', [ClientController::class, "store"])->name("dashboard.client.store");

    Route::get('/faq', [FaqController::class, "index"])->name("dashboard.faq.index");
    Route::put('/faq/{id}/update', [FaqController::class, "update"])->name("dashboard.faq.update");
    Route::delete('/faq/{id}/destroy', [FaqController::class, "destroy"])->name("dashboard.faq.destroy");
    Route::get('/faq/{id}', [FaqController::class, "show"])->name("dashboard.faq.show");
    Route::post('/faq', [FaqController::class, "store"])->name("dashboard.faq.store");

    Route::get('/testimonial', [TestimonialController::class, "index"])->name("dashboard.testimonial.index");
    Route::put('/testimonial/{id}/update', [TestimonialController::class, "update"])->name("dashboard.testimonial.update");
    Route::delete('/testimonial/{id}/destroy', [TestimonialController::class, "destroy"])->name("dashboard.testimonial.destroy");
    Route::get('/testimonial/{id}', [TestimonialController::class, "show"])->name("dashboard.testimonial.show");
    Route::post('/testimonial', [TestimonialController::class, "store"])->name("dashboard.testimonial.store");

    Route::get('/division', [DivisionController::class, "index"])->name("dashboard.division.index");
    Route::put('/division/{id}/update', [DivisionController::class, "update"])->name("dashboard.division.update");
    Route::delete('/division/{id}/destroy', [DivisionController::class, "destroy"])->name("dashboard.division.destroy");
    Route::get('/division/{id}', [DivisionController::class, "show"])->name("dashboard.division.show");
    Route::post('/division', [DivisionController::class, "store"])->name("dashboard.division.store");

    Route::get('/pricing', [PricingController::class, "index"])->name("dashboard.pricing.index");
    Route::put('/pricing/{id}/update', [PricingController::class, "update"])->name("dashboard.pricing.update");
    Route::delete('/pricing/{id}/destroy', [PricingController::class, "destroy"])->name("dashboard.pricing.destroy");
    Route::get('/pricing/{id}', [PricingController::class, "show"])->name("dashboard.pricing.show");
    Route::post('/pricing', [PricingController::class, "store"])->name("dashboard.pricing.store");
    Route::get('/pricings/getDivision', [PricingController::class, "getDivision"])->name("dashboard.pricing.getDivision");
    Route::get('/pricings/getAddOn', [PricingController::class, "getAddOn"])->name("dashboard.pricing.getAddOn");

    // Add on
    Route::get('/addOn', [AddOnController::class, "index"])->name("dashboard.addOn.index");
    Route::put('/addOn/{id}/update', [AddOnController::class, "update"])->name("dashboard.addOn.update");
    Route::delete('/addOn/{id}/destroy', [AddOnController::class, "destroy"])->name("dashboard.addOn.destroy");
    Route::get('/addOn/{id}', [AddOnController::class, "show"])->name("dashboard.addOn.show");
    Route::post('/addOn', [AddOnController::class, "store"])->name("dashboard.addOn.store");

    // Route of news management
    Route::get('/news/manage/create', [NewsController::class, "create"])->name("dashboard.news.create");
    Route::get('/news/category', [NewsCategoryController::class, "index"])->name("news.category.index");
    Route::get('/news/category/{id}', [NewsCategoryController::class, "show"])->name("news.category.show");

    Route::get('/news/manage/{id}/edit', [NewsController::class, "edit"])->name("dashboard.news.edit");
    Route::get('/news', [NewsController::class, "index"])->name("dashboard.news.index");
    Route::put('/news/{id}/update', [NewsController::class, "update"])->name("dashboard.news.update");
    Route::delete('/news/destroy/{id}', [NewsController::class, "destroy"])->name("dashboard.news.destroy");
    Route::get('/news/{id}', [NewsController::class, "show"])->name("dashboard.news.show");
    Route::post('/news', [NewsController::class, "store"])->name("dashboard.news.store");

    Route::put('/news/category/{id}/update', [NewsCategoryController::class, "update"])->name("news.category.update");
    Route::delete('/news/category/{id}/destroy', [NewsCategoryController::class, "destroy"])->name("news.category.destroy");
    Route::post('/news/category', [NewsCategoryController::class, "store"])->name("news.category.store");
    // End of news management routes

    Route::get('/settings/web', [WebController::class, "index"])->name("settings.web.index");
    Route::post('/settings/web', [WebController::class, "store"])->name("settings.web.store");

    Route::get('/settings/social', [SocialMediaController::class, "index"])->name("settings.social.index");
    Route::post('/settings/social', [SocialMediaController::class, "store"])->name("settings.social.store");

    Route::get('/settings/contact', [ContactController::class, "index"])->name("settings.contact.index");
    Route::put('/settings/contact/{id}/update', [ContactController::class, "update"])->name("settings.contact.update");
    Route::delete('/settings/contact/{id}/destroy', [ContactController::class, "destroy"])->name("settings.contact.destroy");
    Route::get('/settings/contact/{id}', [ContactController::class, "show"])->name("settings.contact.show");
    Route::post('/settings/contact', [ContactController::class, "store"])->name("settings.contact.store");

    Route::get('/profile', [ProfileController::class, 'index'])->name("dashboard.user.profile");
    Route::delete('/profile/{id}/delete-picture', [ProfileController::class, 'deletePhotoPic'])->name("dashboard.user.deletePhotoPic");
    Route::put('/profile/upload-picture/{id}', [ProfileController::class, 'uploadPhotoPic'])->name("dashboard.user.uploadPhotoPic");
    Route::get('/profile/password', function () {
        return view('dashboard.profile.password');
    });

    Route::get('/user', [UserController::class, "index"])->name("settings.user.index");
    Route::get('/user/getRole', [UserController::class, "getRole"])->name("settings.user.getrole");
    Route::put('/user/{id}/update-profile', [UserController::class, "updateProfile"])->name("settings.user.update-profile");
    Route::put('/user/{id}/update-password', [UserController::class, "updatePassword"])->name("settings.user.update-password");
    Route::put('/user/{id}/update', [UserController::class, "update"])->name("settings.user.update");
    Route::delete('/user/{id}/destroy', [UserController::class, "destroy"])->name("settings.user.destroy");
    Route::get('/user/{id}', [UserController::class, "show"])->name("settings.user.show");
    Route::post('/user', [UserController::class, "store"])->name("settings.user.store");

    Route::get('/role', [RoleController::class, "index"])->name("settings.role.index");
    Route::put('/role/{id}/update', [RoleController::class, "update"])->name("settings.role.update");
    Route::delete('/role/{id}/destroy', [RoleController::class, "destroy"])->name("settings.role.destroy");
    Route::get('/role/{id}', [RoleController::class, "show"])->name("settings.role.show");
    Route::post('/role', [RoleController::class, "store"])->name("settings.role.store");

    Route::get('/permission', [PermissionController::class, "index"])->name("settings.permission.index");
    Route::put('/permission/{id}/update', [PermissionController::class, "update"])->name("settings.permission.update");
    Route::delete('/permission/{id}/destroy', [PermissionController::class, "destroy"])->name("settings.permission.destroy");
    Route::get('/permission/{id}', [PermissionController::class, "show"])->name("settings.permission.show");
    Route::post('/permission', [PermissionController::class, "store"])->name("settings.permission.store");

    Route::get('/usp', [USPController::class, "index"])->name("dashboard.usp.index");
    Route::put('/usp/{id}/update', [USPController::class, "update"])->name("dashboard.usp.update");
    Route::delete('/usp/{id}/destroy', [USPController::class, "destroy"])->name("dashboard.usp.destroy");
    Route::get('/usp/{id}', [USPController::class, "show"])->name("dashboard.usp.show");
    Route::post('/usp', [USPController::class, "store"])->name("dashboard.usp.store");
});
