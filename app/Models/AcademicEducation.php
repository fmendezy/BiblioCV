<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicEducation extends Model
{
    use HasFactory;

    protected $table = 'academic_educations';
    protected $fillable = [
        'curriculum_id',
        'institution',
        'degree',
        'start_date',
        'end_date'
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
