<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // user lists
    public function list(){
        $users = User::paginate(10);
        return view('user.list',compact('users'));
    }
}
