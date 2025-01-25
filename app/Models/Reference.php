<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $table = 'references';

    protected $fillable = [
        'curriculum_id',
        'name',
        'relation',
        'contact'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
