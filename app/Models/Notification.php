<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'notification_type', 'notification_id', 'read_at'];
    protected $casts = [
        'data' => 'array',
    ];
}
