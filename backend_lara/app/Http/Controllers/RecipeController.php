<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // index
    public function index(Request $request)
    {
        $recipes = Recipe::query()
            ->when($request->id, function ($query) use ($request) {
                $query->where('category_id', '=', $request->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        $categories = Category::query()->get();
        return view("recipes.index", compact('recipes', 'categories'));
    }

    // detail
    public function detail(Recipe $recipe)
    {
        return view('recipes.detail', compact('recipe'));
    }

    // filter recipes by category
    public function filterRecipes(Request $request)
    {
        // $category_id = $request->input('category');
        // if ($category_id == 'all') {
        //     $recipes = Recipe::paginate(10);
        // } else {
        //     $recipes = Recipe::where('category_id', operator: $category_id)->paginate();
        // }

        $recipes = Recipe::query()
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', '=', $request->category);
            })
            ->paginate(10);

        $categories = Category::all();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    // recipe createPage
    public function createPage()
    {
        $categories = Category::query()->get();
        return view('recipes.create', compact('categories'));
    }

    // recipe store
    public function store(Request $request)
    {

        $fields = $request->validate([
            'title' => "required",
            'description' => "required",
            'category_id' => "required",
            'photo' => "required",
        ]);

        if ($request->file('photo')) {
            $path = request()->file('photo')->store('recipes', 'public');
            $fields['photo'] = 'storage/'.$path;
        }

        $recipe = Recipe::create($fields);

        return to_route(route: 'recipes.index')->with('create', value: $recipe['title'] . " has been created");
    }
}
