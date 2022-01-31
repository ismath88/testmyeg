<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminUserPermission extends Model
{
    protected $table = 'admin_user_permissions';
    protected $fillable = [];
    public $timestamps = false;
}
