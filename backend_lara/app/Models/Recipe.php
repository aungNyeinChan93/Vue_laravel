<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilter($query, $filters)
    {
        if (!empty(isset($filters['category']) )) {
            $query->whereHas('category', function ($cateQuery) use ($filters) {
                $cateQuery->where('name', $filters['category']);
            });
        }

        if(!empty(isset($filters['category_id']))){
            $query->whereHas('category',function($cateQuery) use($filters){
                $cateQuery->where('id',$filters['category_id']);
            });
        }

    }
}
