<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// get all recipes
Route::get('recipes',[RecipeController::class,'index']);

// get recipe
Route::get("recipes/{recipe}",[RecipeController::class,'show']);

// delete recipe
Route::delete("recipes/{recipe}",[RecipeController::class,'destory']);

// create recipe
Route::post('recipes',[RecipeController::class,'store']);

// update recipe
Route::put('recipes/{recipe}',[RecipeController::class,'update']);

// get categories
Route::get('categories',[CategoryController::class,'index']);

// uploade photo
Route::post('recipes/upload',[RecipeController::class,'upload']);


// users
Route::get("users",[UserController::class,'index']);
