<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'course_id',
        'status',
    ];

    public function online()
    {
        return $this->belongsTo(Online::class);
    }

}
