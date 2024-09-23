<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'service_center_id'];

    public function serviceCenter()
    {
        return $this->belongsTo(ServiceCenter::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_group')
                    ->withPivot(['valid_from', 'valid_to', 'comment'])
                    ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_group')
                    ->withPivot(['valid_from', 'valid_to'])
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
