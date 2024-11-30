<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventService
{
    public function create(array $data)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $imagePath = 'events/' . Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/events'), $imagePath); // Save image using move()
            $data['image'] = $imagePath;
        }

        return Event::create($data);
    }

    public function update(Event $event, array $data)
    {
        if (isset($data['image'])) {
           
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }
            $image = $data['image'];
            $imagePath = 'events/' . Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/events'), $imagePath);
            $data['image'] = $imagePath;
        }
        $event->update($data);

        return $event;
    }

    public function delete(Event $event)
    {
       
        if ($event->image && file_exists(public_path($event->image))) {
            unlink(public_path($event->image));
        }

        return $event->delete();
    }

    public function getAll()
    {
        return Event::paginate(40);
    }

    public function getByUUid($id)
    {
        return Event::where('uuid',$id)->firstOrFail();
    }
}