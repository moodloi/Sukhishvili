<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ['student_id', 'parent_id', 'student_package_id', 'amount', 'status', 'payment_method', 'transaction_id', 'notes'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function studentPackage()
    {
        return $this->belongsTo(StudentPackage::class);
    }
}
