<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherGroup extends Pivot
{
    use SoftDeletes;

    protected $table = 'teacher_group';
    protected $fillable = ['user_id', 'group_id', 'valid_from', 'valid_to', 'comment'];
}

