<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    protected $table = 'work_experiences';

    protected $fillable = [
        'curriculum_id',
        'position',
        'company',
        'start_date',
        'end_date',
        'responsibilities',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
