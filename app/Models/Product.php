<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    protected $fillable = [
        'uuid', 'manufacturer_id', 'country_import_id', 'country_madeIn_id', 'product_group_id', 
        'weight', 'packing', 'title', 'title_slug', 'content', 'body', 'type', 'images'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
            $model->generateTitleSlug();
        });
        static::updating(function ($model) {
            $model->generateTitleSlug();
        });
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function countryImport()
    {
        return $this->belongsTo(Country::class, 'country_import_id');
    }

    public function countryMadeIn()
    {
        return $this->belongsTo(Country::class, 'country_made_in_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function saveModel($data)
    {
        try {
            $product = new Product();
            $product->manufacturer_id = $data['manufacturer_id'];
            $product->country_import_id = $data['country_import_id'];
            $product->country_made_in_id = $data['country_made_in_id'];
            $product->category_id = $data['category_id'];
            $product->weight = $data['weight'];
            $product->packing = $data['packing'];
            $product->title = $data['title'];
            $product->content = $data['content'];
            $product->body = $data['body'];
            $product->type = $data['type'];
            $images= [];
            foreach ($data['images'] as $key => $images) {
                $imageName = (string) Str::uuid().'-'.Str::random(15).'.'.$images->getClientOriginalExtension();
                $images->move(public_path('/product'),$imageName);
                $images[] = 'product/' . $imageName; 
            }
            $product->images = json_encode($images);
            $product->save();
            return $product;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function updateModel($data){
        $this->manufacturer_id = $data['manufacturer_id'];
        $this->country_import_id = $data['country_import_id'];
        $this->country_made_in_id = $data['country_made_in_id'];
        $this->product_group_id = $data['product_group_id'];
        $this->weight = $data['weight'];
        $this->packing = $data['packing'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->body = $data['body'];
        $this->type = $data['type'];
        $this->save();
    }
    public function deleteModel($data){
        $images = json_decode($this->images, true);
        foreach ($images as $key => $image) {
            if(file_exists(public_path('/product/'.$image->image))){
                unlink(public_path('/product/'.$image->image));
            }
            
        }
        $this->delete();
    }
    public function generateTitleSlug()
    {
        $slug = Str::slug($this->title);
        $existingProduct = Product::where('id','!=',$this->id)->where('title_slug', $slug)->first();
        $count = 1;
        while ($existingProduct) {
            $slug = Str::slug($this->title) . '-' . $count;
            $existingProduct = Product::where('id','!=',$this->id)->where('title_slug', $slug)->first();
            $count++;
        }

        $this->title_slug = $slug;
    }
}
