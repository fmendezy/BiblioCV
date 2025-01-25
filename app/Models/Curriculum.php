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
        'birthdate',
        'marital_status',
        'email',
        'phone',
        'photo',
        'job_title',
        'profile_summary',
        'summary',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
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
