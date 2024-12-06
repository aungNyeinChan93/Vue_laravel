<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // index
    public function index(Request $request){
        $recipes = Recipe::query()
                    ->when($request->id,function($query) use($request) {
                        $query->where('category_id','=',$request->id);
                    })
                    ->paginate(10);
        $categories = Category::query()->get();
        return view("recipes.index",compact('recipes','categories'));
    }

    // detail
    public function detail(Recipe $recipe){
        return view('recipes.detail',compact('recipe'));
    }
}
