<?php

use App\Http\Controllers\Coach\CalenderController;
use App\Http\Controllers\Coach\ContactController;
use App\Http\Controllers\Coach\DashboardController;
use App\Http\Controllers\Coach\FacilityController;
use App\Http\Controllers\Coach\FileController;
use App\Http\Controllers\Coach\FoodController;
use App\Http\Controllers\Coach\MessageController;
use App\Http\Controllers\Coach\ParticipantsController;
use App\Http\Controllers\Coach\ProfileController;
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
        Route::group(['namespace' => 'Coach' ,'middleware' => ['auth:coach','verified'] , 'as'=>'coach.' , 'prefix' => 'coach'],function(){

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


            Route::group(['prefix' => 'participant'],function(){
                Route::get('/',[ParticipantsController::class,'index'])->name('participants');
                Route::get('/view/{id}',[ParticipantsController::class,'view'])->name('participants.view');
                Route::get('/document/{id}', [ParticipantsController::class, 'document'])->name('participants.document');

            });

            Route::group(['prefix'=>'file'  ],function(){
                Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');
            });

            Route::group(['prefix'=>'facility'  ],function(){
                Route::get('/', [FacilityController::class, 'index'])->name('facilities');
                Route::get('/view/{id}', [FacilityController::class, 'view'])->name('facilities.view');
            });

            Route::group(['prefix'=>'food'  ],function(){
                Route::get('/', [FoodController::class, 'index'])->name('foods');
                // Route::get('/view/{id}', [FoodController::class, 'view'])->name('foods.view');
            });

            Route::group(['prefix'=>'message'  ],function(){
                Route::get('/', [MessageController::class, 'index'])->name('messages');
                Route::get('/create', [MessageController::class, 'create'])->name('messages.create');
                Route::get('/create-admin', [MessageController::class, 'createadmin'])->name('messages.createadmin');
                Route::post('/store', [MessageController::class, 'store'])->name('messages.store');
                Route::post('/store-admin', [MessageController::class, 'storeadmin'])->name('messages.storeadmin');
                Route::get('/view/{id}', [MessageController::class, 'view'])->name('messages.view');
                Route::get('/send', [MessageController::class, 'send'])->name('messages.send');
                Route::get('/recive', [MessageController::class, 'recive'])->name('messages.recive');
            });

            Route::group(['prefix' =>'contact'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('contacts');
                Route::get('/view/{id}', [ContactController::class, 'view'])->name('contacts.view');
            });

            Route::group(['prefix'=>'calender'  ],function(){
                Route::get('/', [CalenderController::class, 'index'])->name('calenders');
            });



        });

});


require __DIR__.'/authcoach.php';
