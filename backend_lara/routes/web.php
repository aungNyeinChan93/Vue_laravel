<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::redirect('home','/',302);
Route::get('/', function () {
    return view('user.home');
});


Route::get("test/{test?}",function($test = 'test'){
    dd('test',$test);
});

Route::get("users",function(){
    $user = User::all();
    dd($user);
});


Route::get("recipes",[RecipeController::class,'index'])->name('recipes.index');
Route::get("recipes/detail/{recipe}",action: [RecipeController::class,'detail'])->name('recipes.detail');
Route::post('recipes/filter-recipes', [RecipeController::class, 'filterRecipes'])->name(name: 'recipes.filter');


Route::get('users/list',[UserController::class,'list'])->name('users.list');
