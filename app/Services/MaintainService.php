<?php

namespace App\Services;

use App\Models\Maintain;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MaintainService
{
    /**
     * Create a new maintain record.
     *
     * @param array $data
     * @return Maintain
     */
    public function getBySlug($slug)
    {
        return Maintain::where('uuid', $slug)->firstOrFail();
    }
    public function getAll()
    {
        return Maintain::all();
    }
    public function createMaintain(array $data): Maintain
    {
        $maintain = new Maintain();
        $maintain->meta_title = $data['meta_title'];
        $maintain->meta_description = $data['meta_description'];
        $maintain->meta_keywords = $data['meta_keywords'];
        $maintain->title = $data['title'];
        $maintain->title_slug = $this->generateUniqueSlug($data['title']);
        $maintain->body = $data['body'] ?? null;
        $maintain->image = $this->handleImage($data['image']);
        $maintain->save();
        return $maintain;
    }

    /**
     * Update an existing maintain record.
     *
     * @param Maintain $maintain
     * @param array $data
     * @return Maintain
     */
    public function updateMaintain(Maintain $maintain, array $data): Maintain
    {
        $maintain->title = $data['title'];
        $maintain->meta_title = $data['meta_title'];
        $maintain->meta_description = $data['meta_description'];
        $maintain->meta_keywords = $data['meta_keywords'];
        $maintain->title_slug = $this->generateUniqueSlug($data['title'], $maintain->id);
        $maintain->body = $data['body'];
        if (!empty($data['image'])) {
            $this->deleteImage($maintain->image);
            $maintain->image = $this->handleImage($data['image']);
        }
        $maintain->save();
        return $maintain;
    }
    public function deleteMaintain(Maintain $maintain): void
    {
        $this->deleteImage($maintain->image);
        $maintain->delete();
    }

    private function generateUniqueSlug(string $title, int $maintainId = null): string
    {
        $slug = Str::slug($title);
        $counter = 0;
        while (Maintain::where('title_slug', $slug)
            ->when($maintainId, fn($query) => $query->where('id', '!=', $maintainId))
            ->exists()) {
            $counter++;
            $slug = Str::slug($title) . '-' . $counter;
        }
        return $slug;
    }

    private function handleImage($image): string
    {
        $imageName = Str::uuid() . '-' . Str::random(15) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/service'), $imageName);

        return 'service/' . $imageName; // Save relative path
    }

    /**
     * Delete an image from the filesystem.
     *
     * @param string|null $image
     * @return void
     */
    private function deleteImage(?string $image): void
    {
        if (!$image) {
            return;
        }
        $fullPath = public_path($image);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}