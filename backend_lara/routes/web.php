<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;

Route::redirect('home','/',302);
Route::get('/', function () {
    return view('user.home');
})->name('home');


Route::get("test/{test?}",function($test = 'test'){
    dd('test',$test);
});

Route::get("users",function(){
    $user = User::all();
    dd($user);
});


// product fetching
Route::get('fetch/products', function () {
    $res = file_get_contents("https://fakestoreapi.com/products");
    $products = json_decode($res);
    return view('tests.products',compact('products'));
})->name('fetch.products');

Route::get("fetch/products/detail/{product}",function($product){
    $product = Http::get('https://fakestoreapi.com/products/'.$product)->object();
    return view("tests.productDetail",compact('product'));
})->name(name: 'fetch.productDetail');



Route::get("recipes",[RecipeController::class,'index'])->name('recipes.index');
Route::get("recipes/detail/{recipe}",action: [RecipeController::class,'detail'])->name('recipes.detail');
Route::post('recipes/filter-recipes', [RecipeController::class, 'filterRecipes'])->name(name: 'recipes.filter');


Route::get('users/list',[UserController::class,'list'])->name('users.list');
