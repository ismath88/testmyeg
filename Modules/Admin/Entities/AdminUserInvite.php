<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminUserInvite extends Model
{
    protected $table = 'admin_user_invites';
    protected $fillable = [];
    public $timestamps = false;
}
