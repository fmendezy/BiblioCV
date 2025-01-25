<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',
        'company',
        'position',
        'start_date',
        'end_date',
        'description'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
