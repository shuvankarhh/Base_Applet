<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SetClientController;
use App\Http\Controllers\SetProjectController;
use Illuminate\Http\Request;
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


Route::middleware(['auth','RestrictedUrl'])->group(function(){
    Route::get('action', [ActionController::class, 'index'])->name('action');
});


Route::middleware(['auth'])->group(function(){
    Route::get('setup', [SetupController::class, 'index'])->name('Setup');

    Route::get('set-client', [SetClientController::class, 'create'])->name('set-client.create');
    Route::post('set-client', [SetClientController::class, 'store'])->name('set-client.store');

    Route::get('set-project', [SetProjectController::class, 'create'])->name('set-project.create');
    Route::post('set-project', [SetProjectController::class, 'store'])->name('set-project.store');

    Route::get('step_one', [SetupController::class, 'createStepOne'])->name('StepOne');
    Route::post('step_one', [SetupController::class, 'postCreateStepOne'])->name('PostStepOne');

    Route::get('step_two', [SetupController::class, 'createStepTwo'])->name('StepTwo');
    Route::post('step_two', [SetupController::class, 'postcreateStepTwo'])->name('PostStepTwo');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('user/create', [UserController::class, 'create'])->name('userCreate');
    Route::post('users/create', [UserController::class, 'store'])->name('storeUser');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('user/edit/{id}', [UserController::class, 'update'])->name('userUpdate');
    Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('userDelete');
});

Route::get('/', function () {
    return redirect('/setup');
});

Route::get('clear_cache', function () {
    \Artisan::call('optimize:clear');
    dd("clear cache");
});

Route::get('migrate', function () {
    \Artisan::call('migrate');
    dd("run migrations");
});

Route::get('wipe', function () {
    \Artisan::call('db:wipe');
    \Artisan::call('migrate');
    dd("run migrations");
});

Route::get('seeder', function () {
    \Artisan::call('db:seed', array('--class' => 'CreateAdminUserSeeder'));
    \Artisan::call('db:seed', array('--class' => 'CreateDummyDataSeeder'));
    dd("run seeder");
});

Route::get('/reset', function(Request $request) {
    $request->session()->forget('client_id');
    $request->session()->forget('project_id');
    return redirect()->route('StepOne');
})->name('reset');

Auth::routes();
