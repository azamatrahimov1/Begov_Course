<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Lesson extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'name_video', 'video', 'name_image', 'image', 'voice', 'pdf', 'homework', 'answer'];

    //lesson_like
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function likes() {
        return $this->belongsToMany(User::class, 'lesson_like')->withTimestamps();
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'name_video' => $this->name_video,
            'name_image' => $this->name_image,
            'homework' => $this->homework,
            'answer' => $this->answer,
        ];
    }
}
