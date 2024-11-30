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
        $category = new Category();
        $category->name = $data['name'];
        $imageName = (string) Str::uuid().'-'.Str::random(15).'.'.$data['image']->getClientOriginalExtension();
        $data['image']->move(public_path('/category'),$imageName);
        $imagesName = 'category/' . $imageName; 
        $category->image = $imagesName;
        $category->save();
        return $category;
    }

    public function getById($id)
    {
        return $this->getByUuid($id);
    }

    public function update($id, array $data)
    {
        $category = $this->getByUuid($id);
        $category->name = $data['name'];
        if(isset($data['image'])){
            $imageName = (string) Str::uuid().'-'.Str::random(15).'.'.$data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('/category'),$imageName);
            $imagesName = 'category/' . $imageName; 
            if(file_exists(public_path($category->image))){
                unlink(public_path($category->image));
            }
            $category->image = $imagesName;
        }
        
        
        $category->save();
        return $category;
    }

    public function delete($id)
    {
        $category =  $this->getByUuid($id);
        if(file_exists(public_path($category->image))){
            unlink(public_path($category->image));
        }
        $category->delete();
    }
}