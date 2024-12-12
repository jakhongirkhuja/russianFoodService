<?php
// app/Services/RecipeCategoryService.php

namespace App\Services;

use App\Models\RecipeCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RecipeCategoryService
{
    // Create a new recipe category
    public function create(array $data)
    {
        // If image is included, handle file upload using move()
        if (isset($data['image'])) {
            $data['image'] = $this->handleImageUpload($data['image']);
        }

       
        $data['uuid'] = \Illuminate\Support\Str::orderedUuid();
           
      
        return RecipeCategory::create($data);
    }

    // Get all recipe categories
    public function getAll()
    {
        return RecipeCategory::all();
    }

    // Get a single recipe category by UUID
    public function getByUuid($uuid)
    {
        $category = RecipeCategory::where('uuid', $uuid)->first();

        if (!$category) {
            throw new ModelNotFoundException('Recipe category not found');
        }

        return $category;
    }

    // Update an existing recipe category by UUID
    public function update($uuid, array $data)
    {
        $category = $this->getByUuid($uuid);

        // If image is included, handle file upload using move()
        if (isset($data['image'])) {
            // Delete old image if it exists using unlink
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $data['image'] = $this->handleImageUpload($data['image']);
        }

        $category->update($data);

        return $category;
    }

    // Delete a recipe category by UUID
    public function delete($uuid)
    {
        $category = $this->getByUuid($uuid);

        // Delete image if it exists using unlink
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return $category;
    }

    // Handle image upload (moving to the public directory)
    private function handleImageUpload($image)
    {
        // Generate a unique file name
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Move the image to the desired directory inside the public folder
        $image->move(public_path('recipe_images'), $imageName);

        return 'recipe_images/' . $imageName;
    }
}
