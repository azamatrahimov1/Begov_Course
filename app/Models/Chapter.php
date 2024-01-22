<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Chapter extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name'];

    public function videos()
    {
        return $this->hasMany(Video::class, 'chapter_id', 'id');
    }

    public function grammar()
    {
        return $this->hasMany(Grammar::class, 'chapter_id', 'id');
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
