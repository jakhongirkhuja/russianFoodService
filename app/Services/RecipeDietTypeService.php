<?php

// app/Services/RecipeDietTypeService.php

namespace App\Services;

use App\Models\RecipeDietType;

class RecipeDietTypeService
{
    public function create(array $data)
    {
        return RecipeDietType::create([
            'uuid' => \Illuminate\Support\Str::orderedUuid(),
            'title' => $data['title'],
        ]);
    }

    public function getAll()
    {
        return RecipeDietType::all();
    }

    public function getByUuid($uuid)
    {
        return RecipeDietType::where('uuid', $uuid)->firstOrFail();
    }

    public function update($uuid, array $data)
    {
        $dietType = $this->getByUuid($uuid);
        $dietType->update($data);

        return $dietType;
    }

    public function delete($uuid)
    {
        $dietType = $this->getByUuid($uuid);
        $dietType->delete();

        return $dietType;
    }
}
