<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationOnServiceController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\VerificationController;

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
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');


Route::group(['middleware' => 'verified_email'], function () {

    Route::group(['middleware' => 'auth', 'checkActive' ], function () {
        Route::resource('news', NewsController::class)->only(['show']);
        Route::resource('vacancy', VacancyController::class)->only(['show']);

        Route::get('user', [UserController::class, 'userPanel'])->name('user.user');
        Route::get('user/application', [UserController::class, 'userPanelApplication'])->name('user.application');
        Route::get('user/application-service', [UserController::class, 'userPanelApplicationService'])->name('user.application-service');
        Route::get('user/analytic', [UserController::class, 'userPanelAnalytic'])->name('user.analytic')->middleware('partner');
        Route::put('user/save', [UserController::class, 'userPanelSave'])->name('user.save');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/projects', [HomeController::class, 'paginate'])->name('projects.paginate');
    Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');



    Route::resource('news', NewsController::class)->only(['index']);
    Route::resource('service', ServiceController::class)->only(['index', 'show']);
    Route::resource('project', ProjectController::class)->only(['index', 'show']);
    Route::resource('partners', PartnersController::class)->only(['index', 'show']);
    Route::resource('vacancy', VacancyController::class)->only(['index']);


    Route::post('apply-vacancy', [ApplicationController::class, 'apply'])->name('apply');
    Route::post('apply-service', [ApplicationOnServiceController::class, 'apply'])->name('apply.service');

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [HomeController::class, 'adminPanel'])->name('news.admin');
    Route::resource('news', NewsController::class)->only(['store', 'create', 'edit', 'update', 'destroy']);
    Route::put('news/{id}/update-active', [NewsController::class, 'updateActive'])->name('news.updateActive');
    Route::get('news/search', [NewsController::class, 'search'])->name('news.search');
    Route::get('news/date-search', [NewsController::class, 'dateSearch'])->name('news.dateSearch');

    Route::resource('service', ServiceController::class)->only(['store', 'create', 'edit', 'update', 'destroy']);
    Route::get('service', [ServiceController::class, 'adminPanel'])->name('service.admin');
    Route::put('service/{id}/update-active', [ServiceController::class, 'updateActive'])->name('service.updateActive');
    Route::get('services/search', [ServiceController::class, 'search'])->name('service.search');

    Route::resource('project', ProjectController::class)->only(['store', 'create', 'edit', 'update', 'destroy']);
    Route::get('project', [ProjectController::class, 'adminPanel'])->name('project.admin');
    Route::put('project/{id}/update-active', [ProjectController::class, 'updateActive'])->name('project.updateActive');
    Route::get('projects/search', [ProjectController::class, 'search'])->name('project.search');
    Route::get('projects/date-search', [ProjectController::class, 'dateSearch'])->name('project.dateSearch');

    Route::resource('vacancy', VacancyController::class)->only(['store', 'create', 'edit', 'update', 'destroy']);
    Route::get('vacancy', [VacancyController::class, 'adminPanel'])->name('vacancy.admin');
    Route::put('vacancy/{id}/update-active', [VacancyController::class, 'updateActive'])->name('vacancy.updateActive');
    Route::get('vacancies/search', [VacancyController::class, 'search'])->name('vacancy.search');

    Route::resource('partner', PartnersController::class)->only(['store', 'create', 'edit', 'update', 'destroy']);
    Route::get('partner', [PartnersController::class, 'adminPanel'])->name('partner.admin');
    Route::put('partner/{id}/update-active', [PartnersController::class, 'updateActive'])->name('partner.updateActive');
    Route::get('partners/search', [PartnersController::class, 'search'])->name('partner.search');

    Route::get('application', [ApplicationController::class, 'adminPanel'])->name('application.admin');
    Route::put('application/{id}/update-status', [ApplicationController::class, 'updateStatus'])->name('application.updateStatus');
    Route::post('application/{id}/update-status', [ApplicationController::class, 'updateStatusCreateComment'])->name('application.updateStatusCreateComment');
    Route::get('applications/search', [ApplicationController::class, 'search'])->name('application.search');
    Route::get('applications/date-search', [ApplicationController::class, 'dateSearch'])->name('application.dateSearch');

    Route::get('application-service', [ApplicationOnServiceController::class, 'adminPanel'])->name('application-service.admin');
    Route::put('application-service/{id}/update-status', [ApplicationOnServiceController::class, 'updateStatus'])->name('application-service.updateStatus');
    Route::get('application-services/search', [ApplicationOnServiceController::class, 'search'])->name('application-service.search');
    Route::get('applications-service/date-search', [ApplicationOnServiceController::class, 'dateSearch'])->name('application-service.dateSearch');

    Route::get('user', [UserController::class, 'adminPanel'])->name('user.admin');
    Route::get('users/search', [UserController::class, 'search'])->name('user.search');
    Route::get('user/date-search', [UserController::class, 'dateSearch'])->name('user.dateSearch');
    Route::put('user/{id}/update-role', [UserController::class, 'updateRole'])->name('user.updateRole');
    Route::put('user/{id}/update-active', [UserController::class, 'updateActive'])->name('user.updateActive');

    Route::get('analytic/accident', [HomeController::class, 'analyticAccidentAdminPanel'])->name('analytic.accident.admin');
    Route::get('analytic/objects', [HomeController::class, 'analyticObjectsAdminPanel'])->name('analytic.objects.admin');

});

Auth::routes();

Route::get('/banned', function () {
    return view('banned');
})->name('banned');



// Route::get('/verification', [VerificationController::class, 'showVerificationForm'])->name('verification.form');
// Route::post('/verification', [VerificationController::class, 'verifye'])->name('verification.verify');
