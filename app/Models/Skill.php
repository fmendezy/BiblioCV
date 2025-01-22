<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $table = 'skills';

    protected $fillable = [
        'curriculum_id',
        'skill',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
