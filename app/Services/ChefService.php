<?php
namespace App\Services;

use App\Models\Chef;
use Illuminate\Support\Str;

class ChefService
{
    public function getAll()
    {
        return Chef::all();
    }
    public function getByUuid($uuid)
    {
        
        return Chef::where('uuid', $uuid)->firstOrFail();
    }
    public function create(array $data)
    {
        $chef = new Chef();
        $chef->name = $data['name'];
        $imageName = (string) Str::uuid().'-'.Str::random(15).'.'.$data['image']->getClientOriginalExtension();
        $data['image']->move(public_path('/chef'),$imageName);
        $imagesName = 'chef/' . $imageName; 
        $chef->image = $imagesName;
        $chef->meta_title = $data['meta_title'];
        $chef->meta_description = $data['meta_description'];
        $chef->meta_keywords = $data['meta_keywords'];
        $chef->save();
        return $chef;
    }

  

    public function update($id, array $data)
    {
        $chef = $this->getByUuid($id);
        $chef->name = $data['name'];
        if(isset($data['image'])){
            $imageName = (string) Str::uuid().'-'.Str::random(15).'.'.$data['image']->getClientOriginalExtension();
            $data['image']->move(public_path('/chefs'),$imageName);
            $imagesName = 'chefs/' . $imageName; 
            if(file_exists(public_path($chef->image))){
                unlink(public_path($chef->image));
            }
            $chef->image = $imagesName;
        }
        $chef->meta_title = $data['meta_title'];
        $chef->meta_description = $data['meta_description'];
        $chef->meta_keywords = $data['meta_keywords'];
        $chef->save();
        return $chef;
    }

    public function delete($id)
    {
        $chef =  $this->getByUuid($id);
        if(file_exists(public_path($chef->image))){
            unlink(public_path($chef->image));
        }
        $chef->delete();
    }
}