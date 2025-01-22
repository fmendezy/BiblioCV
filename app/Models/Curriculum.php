<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AcademicEducation;
use App\Models\WorkExperience;
use App\Models\AdditionalTraining;
use App\Models\Skill;
use App\Models\Reference;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'rut',
        'name',
        'email',
        'phone',
        'job_title',
        'profile_summary',
        'photo',
    ];

    public function academicEducations()
    {
        return $this->hasMany(AcademicEducation::class);
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function additionalTrainings()
    {
        return $this->hasMany(AdditionalTraining::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }
}
