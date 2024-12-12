<?php

// app/Services/RecipeProductTypeService.php

namespace App\Services;

use App\Models\RecipeProductType;

class RecipeProductTypeService
{
    public function create(array $data)
    {
        return RecipeProductType::create([
            'uuid' => \Illuminate\Support\Str::uuid(),
            'title' => $data['title'],
        ]);
    }

    public function getAll()
    {
        return RecipeProductType::all();
    }

    public function getByUuid($uuid)
    {
        return RecipeProductType::where('uuid', $uuid)->firstOrFail();
    }

    public function update($uuid, array $data)
    {
        $productType = $this->getByUuid($uuid);
        $productType->update($data);

        return $productType;
    }

    public function delete($uuid)
    {
        $productType = $this->getByUuid($uuid);
        $productType->delete();

        return $productType;
    }
}
