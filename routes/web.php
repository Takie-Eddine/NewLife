<?php

use App\Http\Controllers\User\CoachController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\FacilityController;
use App\Http\Controllers\User\FileController;
use App\Http\Controllers\User\FoodController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['namespace' => 'User' ,'middleware' => ['auth:web','verified'] , 'as'=>'user.' , 'prefix' => 'user'],function(){

            Route::get('/',[DashboardController::class,'index'])->name('dashboard');

            Route::group(['prefix'=>'profile'  ],function(){
                Route::get('/', [ProfileController::class, 'index'])->name('profile');
                Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
                Route::post('/update', [ProfileController::class, 'update_email'])->name('profile.update_email');
                Route::put('/update', [ProfileController::class, 'update_password'])->name('profile.update_password');
                Route::delete('/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
                Route::get('/document/{id}', [ProfileController::class, 'document'])->name('profile.document');
                Route::get('/coach/{id}', [ProfileController::class, 'coach'])->name('profile.coach');
            });

            Route::group(['prefix'=>'coach'  ],function(){
                Route::get('/', [CoachController::class, 'index'])->name('coaches');
                Route::get('/view/{id}', [CoachController::class, 'view'])->name('coaches.view');
                //Route::get('/mycoaches/{id}', [CoachController::class, 'mycoaches'])->name('coaches.mycoaches');
            });

            Route::group(['prefix'=>'file'  ],function(){
                //Route::get('/', [FileController::class, 'index'])->name('files');
                Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');
                //Route::get('/mycoaches/{id}', [CoachController::class, 'mycoaches'])->name('coaches.mycoaches');
            });

            Route::group(['prefix'=>'facility'  ],function(){
                Route::get('/', [FacilityController::class, 'index'])->name('facilities');
                Route::get('/view/{id}', [FacilityController::class, 'view'])->name('facilities.view');
            });

            Route::group(['prefix'=>'food'  ],function(){
                Route::get('/', [FoodController::class, 'index'])->name('foods');
                Route::get('/view/{id}', [FoodController::class, 'view'])->name('foods.view');
            });

            Route::group(['prefix' =>'contact'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('contacts');
                Route::get('/view/{id}', [ContactController::class, 'view'])->name('contacts.view');
            });

        });

});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/coach.php';

