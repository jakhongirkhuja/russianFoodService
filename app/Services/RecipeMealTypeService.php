<?php
// app/Services/RecipeMealTypeService.php

namespace App\Services;

use App\Models\RecipeMealType;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RecipeMealTypeService
{
    // Create a new recipe meal type
    public function create(array $data)
    {

        return RecipeMealType::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'title' => $data['title'],
        ]);
    }

    // Get all recipe meal types
    public function getAll()
    {
        return RecipeMealType::all();
    }

    // Get a single recipe meal type by UUID
    public function getByUuid($uuid)
    {
        $mealType = RecipeMealType::where('uuid', $uuid)->first();

        if (!$mealType) {
            throw new ModelNotFoundException('Recipe meal type not found');
        }

        return $mealType;
    }

    // Update an existing recipe meal type by UUID
    public function update($uuid, array $data)
    {
        $mealType = $this->getByUuid($uuid);
        $mealType->update($data);

        return $mealType;
    }

    // Delete a recipe meal type by UUID
    public function delete($uuid)
    {
        $mealType = $this->getByUuid($uuid);
        $mealType->delete();

        return $mealType;
    }
}
