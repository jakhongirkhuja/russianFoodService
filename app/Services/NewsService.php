<?php

namespace App\Services;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function storeNews($data)
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);
        $data['image'] = $this->uploadImage($data['image']);
        $news = News::create($data);
        $news->tags()->sync($tags); 
        return $news;
    }

    public function updateNews($news, $data)
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        if (isset($data['image'])) {
            $this->deleteImage($news->image);
            $data['image'] = $this->uploadImage($data['image']);
        }

        $news->update($data);
        $news->tags()->sync($tags);

        return $news;
    }

    private function uploadImage($image)
    {
        $path = public_path('news');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $filename);
        return 'news/' . $filename;
    }

    public function deleteImage($imagePath)
    {
        $fullPath = public_path($imagePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}