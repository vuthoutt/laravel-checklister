<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\User\ChecklistController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function() {
    Route::get('welcome',[PageController::class,'welcome'])
    ->name('welcome');
    Route::get('consultation',[PageController::class,'consultation'])
    ->name('consultation');
    Route::get('checklists/{checklist}',[ChecklistController::class,'show'])
    ->name('user.checklists.show');
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function() {
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class)
        ->only(['edit','update']);
        Route::resource('checklist_groups', App\Http\Controllers\Admin\ChecklistGroupController::class);
        Route::resource('checklist_groups.checklists', App\Http\Controllers\Admin\ChecklistController::class);
        Route::resource('checklists.tasks', App\Http\Controllers\Admin\TaskController::class);
        Route::get('users', [App\Http\Controllers\Admin\UserController::class,'index'])->name('users.index');
    });
});
