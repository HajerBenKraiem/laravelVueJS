<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ScategorieController;
use App\Http\Controllers\ArticleController; 
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Api\UploadController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('categories', CategorieController::class);

Route::apiResource('scategories', ScategorieController::class); 
Route::get('/scat/{idcat}', [ScategorieController::class,'showSCategorieByCAT']);


Route::resource('articles', ArticleController::class);

Route::group(['prefix' => 'auth'], function () {
// Routes publiques
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
// Routes protégées
Route::middleware('auth:api')->group(function () {
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('user-profile', [AuthController::class, 'userProfile']);


});
});
Route::post('/upload', [UploadController::class, 'upload']);