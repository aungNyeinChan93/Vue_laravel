<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /*
    # index
    get all recipes
    api/recipes

    get recipes filter by category name (@param category)
    api/recipes?category=Alanis Dach
    */
    public function index()
    {
        try {
            return response()->json([
                'message' => 'success',
                'recipes' => Recipe::filter(request(['category']))
                ->paginate()
            ], 200, ['testheader' => 'test']);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Summary of show
     * get recipe
     * /api/recipes/22
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show($id){
        try {

            $recipe = Recipe::find($id);

            if(!$recipe){
                return response()->json([
                    'message' => 'recipe not found',
                    'status'=>'404'
                ],404);
            }
            return response()->json([
                'message'=>'success',
                'status'=>'200',
                "recipe"=>$recipe
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'message'=>$e->getMessage(),
                "status"=>'500'
            ],500);
        }
    }


    /**
     * Summary of destory
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destory($id){
        try {
            $recipe = Recipe::find($id);
            if(!$recipe){
                return response()->json([
                    'message'=>'recipe not found!',
                    'status'=>404
                ],404);
            }
            $recipe->delete();
            return response()->json([
                'message'=>'delete success',
                'status'=>200,
                "recipe"=> $recipe
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message"=>$th->getMessage(),
                'status'=>500
            ],500);
        }
    }


}

