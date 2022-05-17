<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyListController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::resource('tasks', TaskController::class);

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');
//Route::get('/users/filtering', [UserController::class, 'indexFiltering'])->name('users.indexFiltering');
Route::get('/userFilterLists', [UserController::class, 'getUsersWithLists'])->name('users.getUsersWithLists');
Route::post('/listCreate', [DailyListController::class, 'store'])->name('dailyLists.store');
Route::put('/listUpdate/{id}', [DailyListController::class, 'update'])->name('dailyLists.update');
Route::delete('/listDelete/{id}', [DailyListController::class, 'destroy'])->name('dailyLists.destroy');
//Route::get('/tasks/{id}', [TaskController::class, 'show']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
//    Route::post('/tasks', [TaskController::class, 'store']);
//    Route::put('/tasks/{id}', [TaskController::class, 'update']);
//    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});
