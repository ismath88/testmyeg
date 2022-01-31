<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class MainLevel extends Model
{
    protected $table = 'admin_system_mainlevel';
    protected $fillable = [
        'level_name', 'status',
    ];
	public $timestamps = false;
}
