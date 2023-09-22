<?php

use App\Http\Controllers\Admin\CalenderController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
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
        Route::group(['namespace' => 'Admin' ,'middleware' => ['auth:admin','verified'] , 'as'=>'admin.' , 'prefix' => 'admin'],function(){

            Route::get('/',[DashboardController::class,'index'])->name('dashboard');

            Route::group(['prefix'=>'profile'  ],function(){
                Route::get('/', [ProfileController::class, 'index'])->name('profile');
                Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
                Route::post('/update', [ProfileController::class, 'update_email'])->name('profile.update_email');
                Route::put('/update', [ProfileController::class, 'update_password'])->name('profile.update_password');
                Route::delete('/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');

            });
            Route::group(['prefix'=>'participant'  ],function(){
                Route::get('/', [ParticipantController::class, 'index'])->name('participants');
                Route::get('/create', [ParticipantController::class, 'create'])->name('participants.create');
                Route::post('/store', [ParticipantController::class, 'store'])->name('participants.store');
                Route::get('/view/{id}', [ParticipantController::class, 'view'])->name('participants.view');
                Route::get('/edit/{id}', [ParticipantController::class, 'edit'])->name('participants.edit');
                Route::post('/update/{id}', [ParticipantController::class, 'update'])->name('participants.update');
                Route::get('/activate/{id}', [ParticipantController::class, 'active'])->name('participants.activate');
                Route::get('/delete/{id}', [ParticipantController::class, 'delete'])->name('participants.delete');
                Route::get('/plans/{id}', [ParticipantController::class, 'getplans'])->name('participants.getplans');
                Route::get('/document/{id}', [ParticipantController::class, 'document'])->name('participants.document');
                Route::get('/coach/{id}', [ParticipantController::class, 'coach'])->name('participants.coach');
            });

            Route::group(['prefix'=>'coach'  ],function(){
                Route::get('/', [CoachController::class, 'index'])->name('coaches');
                Route::get('/create', [CoachController::class, 'create'])->name('coaches.create');
                Route::post('/store', [CoachController::class, 'store'])->name('coaches.store');
                Route::get('/view/{id}', [CoachController::class, 'view'])->name('coaches.view');
                Route::get('/participant/{id}', [CoachController::class, 'participant'])->name('coaches.participant');
                Route::get('/edit/{id}', [CoachController::class, 'edit'])->name('coaches.edit');
                Route::post('/update/{id}', [CoachController::class, 'update'])->name('coaches.update');
                Route::get('/activate/{id}', [CoachController::class, 'active'])->name('coaches.activate');
                Route::get('/delete/{id}', [CoachController::class, 'delete'])->name('coaches.delete');

            });

            Route::group(['prefix'=>'program'  ],function(){
                Route::get('/', [ProgramController::class, 'index'])->name('programs');
                Route::get('/create', [ProgramController::class, 'create'])->name('programs.create');
                Route::post('/store', [ProgramController::class, 'store'])->name('programs.store');
                Route::get('/edit/{id}', [ProgramController::class, 'edit'])->name('programs.edit');
                Route::post('/update/{id}', [ProgramController::class, 'update'])->name('programs.update');
                Route::get('/view/{id}', [ProgramController::class, 'view'])->name('programs.view');
                Route::get('/activate/{id}', [ProgramController::class, 'active'])->name('programs.activate');
                Route::get('/delete/{id}', [ProgramController::class, 'delete'])->name('programs.delete');

            });

            Route::group(['prefix'=>'plan'  ],function(){
                Route::get('/', [PlanController::class, 'index'])->name('plans');
                Route::get('/create', [PlanController::class, 'create'])->name('plans.create');
                Route::post('/store', [PlanController::class, 'store'])->name('plans.store');
                Route::get('/edit/{id}', [PlanController::class, 'edit'])->name('plans.edit');
                Route::post('/update/{id}', [PlanController::class, 'update'])->name('plans.update');
                Route::get('/view/{id}', [PlanController::class, 'view'])->name('plans.view');
                Route::get('/activate/{id}', [PlanController::class, 'active'])->name('plans.activate');
                Route::get('/delete/{id}', [PlanController::class, 'delete'])->name('plans.delete');
            });
            Route::group(['prefix'=>'setting'  ],function(){
                Route::get('/', [SettingController::class, 'index'])->name('settings');

            });


            Route::group(['prefix'=>'medical-test'  ],function(){
                Route::get('/', [ReportController::class, 'index'])->name('tests');
                Route::get('/upload', [ReportController::class, 'create'])->name('tests.create');
                Route::post('/store', [ReportController::class, 'store'])->name('tests.store');
                Route::get('/delete/{id}', [ReportController::class, 'delete'])->name('tests.delete');
                Route::get('/download/{id}', [ReportController::class, 'download'])->name('tests.download');
                //Route::get('/view/{id}', [ReportController::class, 'view'])->name('tests.view');
            });

            Route::group(['prefix'=>'facility'  ],function(){
                Route::get('/', [FacilityController::class, 'index'])->name('facilities');
                Route::get('/create', [FacilityController::class, 'create'])->name('facilities.create');
                Route::post('/save', [FacilityController::class, 'store_image'])->name('facilities.store_image');
                Route::post('/store', [FacilityController::class, 'store'])->name('facilities.store');
                Route::get('/view/{id}', [FacilityController::class, 'view'])->name('facilities.view');
                Route::get('/edit/{id}', [FacilityController::class, 'edit'])->name('facilities.edit');
                Route::post('/update/{id}', [FacilityController::class, 'update'])->name('facilities.update');
                Route::get('/delete/{id}', [FacilityController::class, 'delete'])->name('facilities.delete');
                Route::get('/delete-image/{id}', [FacilityController::class, 'delete_image'])->name('facilities.deleteimage');
            });


            Route::group(['prefix'=>'admin'  ],function(){
                Route::get('/', [UserController::class, 'index'])->name('users');
                Route::get('/create', [UserController::class, 'create'])->name('users.create');
                Route::post('/store', [UserController::class, 'store'])->name('users.store');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
                Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
                Route::get('/view/{id}', [UserController::class, 'view'])->name('users.view');
                Route::post('/status/{id}', [UserController::class, 'status'])->name('users.status');
            });


            Route::group(['prefix' =>'role'], function () {
                Route::get('/', [RoleController::class, 'rolepermission'])->name('roles');
                Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
                Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
                Route::post('/update/{id}', [RoleController::class, 'update'])->name('roles.update');
                Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
                Route::get('/view/{id}', [RoleController::class, 'view'])->name('roles.view');

            });

            Route::group(['prefix' =>'task'], function () {
                Route::get('/', [TaskController::class, 'index'])->name('tasks');
                Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
                Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
                Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
                Route::post('/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
                Route::get('/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
                // Route::get('/view/{id}', [TaskController::class, 'view'])->name('tasks.view');
            });

            Route::group(['prefix' =>'food'], function () {
                Route::get('/', [FoodController::class, 'index'])->name('foods');
                Route::get('/create', [FoodController::class, 'create'])->name('foods.create');
                Route::post('/store', [FoodController::class, 'store'])->name('foods.store');
                Route::get('/edit/{id}', [FoodController::class, 'edit'])->name('foods.edit');
                Route::post('/update/{id}', [FoodController::class, 'update'])->name('foods.update');
                Route::get('/delete/{id}', [FoodController::class, 'delete'])->name('foods.delete');
                Route::get('/view/{id}', [FoodController::class, 'view'])->name('foods.view');
            });
            Route::group(['prefix' =>'contact'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('contacts');
                // Route::get('/create', [ContactController::class, 'create'])->name('contacts.create');
                // Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
                // Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('contacts.edit');
                // Route::post('/update/{id}', [ContactController::class, 'update'])->name('contacts.update');
                // Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('contacts.delete');
                // Route::get('/view/{id}', [ContactController::class, 'view'])->name('contacts.view');
            });

            Route::group(['prefix'=>'message'  ],function(){
                Route::get('/', [MessageController::class, 'index'])->name('messages');
                Route::get('/create', [MessageController::class, 'create'])->name('messages.create');
                Route::get('/create-coach', [MessageController::class, 'createcoach'])->name('messages.createcoach');
                Route::post('/store', [MessageController::class, 'store'])->name('messages.store');
                Route::post('/store-coach', [MessageController::class, 'storecoach'])->name('messages.storecoach');
                Route::get('/view/{id}', [MessageController::class, 'view'])->name('messages.view');
                Route::get('/send', [MessageController::class, 'send'])->name('messages.send');
                Route::get('/recive', [MessageController::class, 'recive'])->name('messages.recive');

            });

            // Route::group(['prefix'=>'chat'  ],function(){
            //     Route::get('/', [ChatController::class, 'index'])->name('chats');
            //     Route::get('/create-admin/{id}', [ChatController::class, 'create_admin'])->name('chats.create_admin');
            //     Route::get('/create-coach/{id}', [ChatController::class, 'create_coach'])->name('chats.create_coach');
            //     Route::get('/create-user/{id}', [ChatController::class, 'create_user'])->name('chats.create_user');
            // });

            Route::group(['prefix'=>'calender'  ],function(){
                Route::get('/', [CalenderController::class, 'index'])->name('calenders');
                //Route::get('/create', [CalenderController::class, 'create'])->name('calenders.create');
                Route::post('/store', [CalenderController::class, 'store'])->name('calenders.store');
                Route::patch('/update/{id}', [CalenderController::class, 'update'])->name('calenders.update');
                Route::delete('/destroy/{id}', [CalenderController::class, 'destroy'])->name('calenders.destroy');
            });


            // Route::group(['prefix'=>'feature'  ],function(){
            //     Route::get('/', [FeatureController::class, 'index'])->name('features');
            //     Route::get('/create', [FeatureController::class, 'create'])->name('features.create');
            //     Route::post('/store', [FeatureController::class, 'store'])->name('features.store');
            //     Route::get('/view/{id}', [FeatureController::class, 'view'])->name('features.view');


            // });
            Route::group(['prefix' =>'contact'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('contacts');
                Route::get('/view/{id}', [ContactController::class, 'view'])->name('contacts.view');
            });
        });

});

require __DIR__.'/authadmin.php';
