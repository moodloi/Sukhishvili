<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCenter extends Model
{
    use SoftDeletes;

    protected $fillable = ['business', 'name', 'address', 'phone', 'comment'];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'manager_service_center')
                    ->withPivot(['valid_from', 'valid_to', 'comment'])
                    ->withTimestamps();
    }
}
