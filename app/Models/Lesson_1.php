<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson_1 extends Model
{
    use HasFactory;

    protected $fillable = ['name_video', 'video', 'name_image', 'image', 'voice', 'pdf', 'homework', 'answer'];
}
