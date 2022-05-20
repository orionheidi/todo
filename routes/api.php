<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\DailyList;
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

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/userFilterLists', [DailyListController::class, 'userFilterLists'])->name('dailyLists.userFilterLists');

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/listUpdate/{id}', [DailyListController::class, 'update'])->name('dailyLists.update');
    Route::post('/listCreate', [DailyListController::class, 'store'])->name('dailyLists.store');
    Route::delete('/listDelete/{id}', [DailyListController::class, 'destroy'])->name('dailyLists.destroy');
//    Route::get('/userFilterLists', [DailyListController::class, 'userFilterLists'])->name('dailyLists.userFilterLists');
    Route::post('/taskCreate', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/taskUpdate/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::put('/taskUpdate/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/taskDelete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/listFilterTasks', [TaskController::class, 'listFilterTasks'])->name('tasks.listFilterTasks');
});
