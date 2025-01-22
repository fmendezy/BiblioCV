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
        'start_year',
        'end_year',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
