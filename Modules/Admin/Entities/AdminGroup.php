<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    protected $table = 'admin_usergroup';
    protected $fillable = [
        'usergroup_name', 'status','created_datetime','modified_datetime',
    ];
	public $timestamps = false;
}
