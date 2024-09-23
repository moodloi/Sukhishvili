<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagerServiceCenter extends Pivot
{
    use SoftDeletes;

    protected $table = 'manager_service_center';
    protected $fillable = ['user_id', 'service_center_id', 'valid_from', 'valid_to', 'comment'];
}
