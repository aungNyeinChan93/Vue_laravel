<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    //index recipes
    public function index()
    {
        try {
            return response()->json([
                'message' => 'success',
                'recipes' => Recipe::paginate()
            ], 200, ['testheader' => 'test']);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
