<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CategoryController extends Controller
{
    /**
     * Summary of index
     * /api/categories
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return response()->json([
                'message' => 'success',
                'categories' => Category::all(),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
