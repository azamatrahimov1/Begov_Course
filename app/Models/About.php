<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'address', 'video',  'map', 'telegram_account', 'instagram', 'facebook', 'phone_number'];
}
