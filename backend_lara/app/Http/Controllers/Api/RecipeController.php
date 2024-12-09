<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Validator;

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
                    ->with("category:id,name")
                    ->orderBy("created_at", 'desc')
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
     * /api/recipes/:22
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {

            $recipe = Recipe::where("id",$id)
                ->with('category:id,name')
                ->first();

            if (!$recipe) {
                return response()->json([
                    'message' => 'recipe not found',
                    'status' => '404'
                ], 404);
            }
            return response()->json([
                'message' => 'success',
                'status' => '200',
                "recipe" => $recipe
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                "status" => '500'
            ], 500);
        }
    }


    /**
     * Summary of destory
     * /api/recipes/:id
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destory($id)
    {
        try {
            $recipe = Recipe::find($id);
            if (!$recipe) {
                return response()->json([
                    'message' => 'recipe not found!',
                    'status' => 404
                ], 404);
            }
            $recipe->delete();
            return response()->json([
                'message' => 'delete success',
                'status' => 200,
                "recipe" => $recipe
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Summary of store
     *  post - api/recipes (title,description,photo,category_id)
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator  = Validator::make(request()->all(), [
                'title' => 'required',
                'description' => 'required',
                'photo' => 'required',
                'category_id' => ['required', Rule::exists('categories', 'id')],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => collect($validator->errors())->flatMap(function ($e, $field) {
                        return [$field = $e[0]];
                    }),
                    'status' => 400
                ], 400);
            }

            $recipe = new Recipe();
            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->photo = $request->photo;
            $recipe->category_id = $request->category_id;
            $recipe->save();

            return response()->json([
                'message' => 'recipe store success',
                'status' => 201,
                'recipe' => $recipe
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Summary of update
     * path - /api/recipes/ (title,description,photo,category_id)
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        try {

            $recipe = Recipe::find($id);

            if (!$recipe) {
                return response()->json([
                    'message' => 'recipe not found ! ',
                    'status' => 404
                ], 404);
            }

            $validator = Validator::make(request()->all(), [
                'title' => 'required',
                'description' => 'required',
                'photo' => 'required',
                'category_id' => ['required', Rule::exists('categories', 'id')],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => collect($validator->errors())->flatMap(function ($e, $field) {
                        return [$field = $e[0]];
                    }),
                    'status' => 400
                ], 400);
            }

            $recipe->title = request()->title;
            $recipe->description = request()->description;
            $recipe->photo = request()->photo;
            $recipe->category_id = request()->category_id;
            $recipe->save();

            return response()->json([
                'message' => 'recipe update success',
                'status' => 201,
                'recipe' => $recipe
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Summary of upload
     * post - /recipes/upload
     * @param  mixed $photo (file/image)
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function upload()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'photo' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => collect($validator->errors())->flatMap(function ($e, $field) {
                        return [$field = $e[0]];
                    }),
                    'status' => 400
                ], 400);
            }

            // $fileName = request()->file('photo')->getClientOriginalName();
            // request()->file('photo')->move(public_path('/recipes/'),$fileName);

            $path = request()->photo->store('/recipes', 'public');

            return response()->json([
                'path' => "/storage/" . $path,
                'status' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
