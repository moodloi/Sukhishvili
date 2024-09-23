<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentStudent extends Pivot
{
    use SoftDeletes;

    protected $table = 'parent_student';
    protected $fillable = ['parent_id', 'student_id', 'comment'];
}
