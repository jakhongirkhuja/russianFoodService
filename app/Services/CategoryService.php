<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }
    public function getByUuid($uuid)
    {
        return Category::where('uuid', $uuid)->firstOrFail();
    }
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function getById($id)
    {
        return $this->getByUuid($id);
    }

    public function update($id, array $data)
    {
        $category = $this->getByUuid($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category =  $this->getByUuid($id);
        $category->delete();
    }
}