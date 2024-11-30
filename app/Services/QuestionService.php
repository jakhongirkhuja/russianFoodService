<?php

namespace App\Services;

use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Models\Question;

class QuestionService
{
    // Create Manufacturer
    public function create($data)
    {
        $question = Question::create($data);
        return $question;
    }

    // Get Manufacturer by UUID
    public function getByUuid($uuid)
    {
        return Question::where('uuid', $uuid)->firstOrFail();
    }

    // Update Manufacturer
    public function update($data, $uuid)
    {
        $question = $this->getByUuid($uuid);
        $question->update($data);
        return $question;
    }

    // Delete Manufacturer
    public function delete($uuid)
    {
        $question = $this->getByUuid($uuid);
        $question->delete();
        return $question;
    }

    // Get All Manufacturers
    public function getAll()
    {
        return Question::all();
    }
}