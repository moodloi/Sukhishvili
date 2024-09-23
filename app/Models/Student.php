<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'pid', 'date_of_birth', 'gender', 'comment'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'student_group')
                    ->withPivot(['valid_from', 'valid_to'])
                    ->withTimestamps();
    }

    public function parents()
    {
        return $this->belongsToMany(User::class, 'parent_student')
                    ->withPivot('comment')
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'student_packages')
                    ->withPivot(['start_date', 'end_date', 'status'])
                    ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
