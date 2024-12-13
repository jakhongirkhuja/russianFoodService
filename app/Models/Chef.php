<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Chef extends Model
{
    protected $fillable = [
        'name', 'uuid', 'image', 'name_slug', 
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::orderedUuid()->toString();
            $model->generateTitleSlug();
        });
        static::updating(function ($model) {
            $model->generateTitleSlug();
        });
    }
    public function generateTitleSlug()
    {
        $slug = Str::slug($this->name);
        $existingProduct = Chef::where('id','!=',$this->id)->where('name_slug', $slug)->first();
        $count = 1;
        while ($existingProduct) {
            $slug = Str::slug($this->name) . '-' . $count;
            $existingProduct = Chef::where('id','!=',$this->id)->where('name_slug', $slug)->first();
            $count++;
        }

        $this->name_slug = $slug;
    }
}
