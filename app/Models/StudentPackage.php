<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentPackage extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id', 'package_id', 'start_date', 'end_date', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
