<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //index
    public function index(){
        try {
            $users = User::get();
            if($users){
                return response()->json([
                    'users'=>$users,
                    'status'=>200
                ],200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>$th->getMessage(),
                'status'=>500
            ],500);
        }
    }
}
