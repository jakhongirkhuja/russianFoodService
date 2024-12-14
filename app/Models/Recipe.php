<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'uuid',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'cooking_time',
        'title',
        'image',
        'body',
        'chef_id',
        'title_slug',
        'recipe_categories_uuid',
        'recipe_meal_types_uuid',
        'recipe_product_types_uuid',
        'recipe_diet_types_uuid',
    ];
    public function recipeCategory()
    {
        return $this->belongsTo(RecipeCategory::class, 'recipe_categories_uuid', 'uuid');
    }

    public function recipeMealType()
    {
        return $this->belongsTo(RecipeMealType::class, 'recipe_meal_types_uuid', 'uuid');
    }

    public function recipeProductType()
    {
        return $this->belongsTo(RecipeProductType::class, 'recipe_product_types_uuid', 'uuid');
    }

    public function recipeDietType()
    {
        return $this->belongsTo(RecipeDietType::class, 'recipe_diet_types_uuid', 'uuid');
    }
}
