<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function curriculums()
    {
        return $this->hasManyThrough(Curriculum::class, User::class);
    }
}
