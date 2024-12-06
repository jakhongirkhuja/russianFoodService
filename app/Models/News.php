<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'uuid', 'meta_title', 'meta_description', 'meta_keywords',
        'title', 'image', 'body', 'type', 'category','location','event_date'
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

    public function generateTitleSlug()
    {
        $slug = Str::slug($this->title);
        $existingProduct = News::where('id','!=',$this->id)->where('title_slug', $slug)->first();
        $count = 1;
        while ($existingProduct) {
            $slug = Str::slug($this->title) . '-' . $count;
            $existingProduct = News::where('id','!=',$this->id)->where('title_slug', $slug)->first();
            $count++;
        }

        $this->title_slug = $slug;
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }
}
