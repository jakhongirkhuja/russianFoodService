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
        'title',
        'image',
        'body',
        'title_slug',
        'recipe_categories_uuid',
        'recipe_meal_types_uuid',
        'recipe_product_types_uuid',
        'recipe_diet_types_uuid',
    ];
}
