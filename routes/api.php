<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\QuizController;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\AnswerController;
use App\Http\Controllers\API\V1\CourseController;
use App\Http\Controllers\API\V1\LessonController;
use App\Http\Controllers\API\V1\ModuleController;
use App\Http\Controllers\API\V1\BookShopController;

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

Route::middleware('auth:sanctum')->group(function () {

  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  Route::apiResource('courses', CourseController::class);
  Route::apiResource('users', UserController::class);
  Route::apiResource('publications', PublicationController::class);
  Route::apiResource('answers', AnswerController::class);
  Route::apiResource('quizzes', QuizController::class);
  Route::apiResource('lessons', LessonController::class);
  Route::apiResource('modules', ModuleController::class);
  Route::apiResource('contacts', ContactController::class);
  Route::apiResource('bookshop', BookShopController::class);
  Route::apiResource('roles', RoleController::class);
});


Route::controller(AuthController::class)->group(function () {
  Route::post('login', 'login');
  Route::post('register', 'register');
});
