<?php 

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeService
{
    public function store(array $data)
    {
        // Generate unique slug
        $data['title_slug'] = $this->generateUniqueSlug($data['title']);

        // Handle image upload
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('recipe_images'), $imageName);
            $data['image'] = 'recipe_images/' . $imageName;
        }

        return Recipe::create($data);
    }

    public function update(Recipe $recipe, array $data)
    {
        // Generate unique slug only if title changes
        if (isset($data['title']) && $data['title'] !== $recipe->title) {
            $data['title_slug'] = $this->generateUniqueSlug($data['title']);
        }

        // Handle image update
        if (isset($data['image'])) {
            if ($recipe->image && file_exists(public_path($recipe->image))) {
                unlink(public_path($recipe->image));
            }
            $image = $data['image'];
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('recipe_images'), $imageName);
            $data['image'] = 'recipe_images/' . $imageName;
        }

        $recipe->update($data);

        return $recipe;
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Recipe::where('title_slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
