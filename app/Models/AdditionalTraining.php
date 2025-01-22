<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalTraining extends Model
{
    use HasFactory;
    protected $table = 'additional_trainings';

    protected $fillable = [
        'curriculum_id',
        'course_name',
        'institution',
        'year',
        'duration_hours',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
