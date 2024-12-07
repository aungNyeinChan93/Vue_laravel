<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RecipeController;
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

// get categories
Route::get('categories',[CategoryController::class,'index']);
