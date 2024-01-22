<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PreIELTS extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'desc'];

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->name,
        ];
    }
}
