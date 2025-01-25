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
        'name'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
