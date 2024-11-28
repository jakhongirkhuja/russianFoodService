<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'uuid', 'meta_title', 'meta_description', 'meta_keywords',
        'title', 'image', 'body', 'type'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }
}
