<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatternSize extends Model
{
    protected $fillable = ['pattern_id', 'size_label', 'measurements', 'pdf_path'];

    public function pattern()
    {
        return $this->belongsTo(Pattern::class);
    }
}
