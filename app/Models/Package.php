<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'is_active', 'valid_from', 'valid_to'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_packages')
                    ->withPivot(['start_date', 'end_date', 'status'])
                    ->withTimestamps();
    }
}

