<?php

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

