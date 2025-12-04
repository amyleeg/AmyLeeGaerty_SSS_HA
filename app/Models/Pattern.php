<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id',
        'difficulty', 'description',
        'preview_image', 'pattern_pdf'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->hasMany(PatternSize::class);
    }
}
