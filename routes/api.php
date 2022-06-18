<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PersonalityController;
use App\Http\Controllers\QuestionController;
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

Route::group(['namespace' => 'Auth'], function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('me', [AuthController::class, 'me'])->middleware('auth');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::post('register-admin', [AuthController::class, 'registerAdmin'])->middleware('isAdmin');
});

Route::group(['namespace' => 'admin', 'middleware' => 'isAdmin'], function () {
    Route::post('add-assessment', [AssessmentController::class, 'store']);
    Route::put('update-assessment/{assessment}', [AssessmentController::class, 'update']);
    Route::delete('delete-assessment/{assessment}', [AssessmentController::class, 'destroy']);

    Route::post('add-career', [CareerController::class, 'store']);
    Route::put('update-career/{career}', [CareerController::class, 'update']);
    Route::delete('delete-career/{career}', [CareerController::class, 'destroy']);

    Route::post('add-question', [QuestionController::class, 'store']);
    Route::put('update-question/{question}', [QuestionController::class, 'update']);
    Route::delete('delete-question/{question}', [QuestionController::class, 'destroy']);

    Route::put('update-option/{option}', [OptionController::class, 'update']);
    Route::delete('delete-option/{option}', [OptionController::class, 'destroy']);

    Route::post('add-personality', [PersonalityController::class, 'store']);
    Route::put('update-personality/{personality}', [PersonalityController::class, 'update']);
    Route::delete('delete-personality/{personality}', [PersonalityController::class, 'destroy']);
});

Route::group(['namespace' => 'user', 'middleware' => 'auth'], function () {

});

Route::group(['namespace' => 'guest'], function () {
    Route::get('assessments', [AssessmentController::class, 'index']);
    Route::get('careers', [CareerController::class, 'index']);
    Route::get('questions', [QuestionController::class, 'index']);
});
