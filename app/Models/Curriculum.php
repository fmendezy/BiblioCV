<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = [
        'user_id',
        'rut',
        'name',
        'email',
        'phone',
        'profile_image',
        'summary',
        'civil_status',
    ];
    
    public function educations()
    {
        return $this->hasMany(AcademicEducation::class);
    }
    
    public function experiences()
    {
        return $this->hasMany(WorkExperience::class);
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
