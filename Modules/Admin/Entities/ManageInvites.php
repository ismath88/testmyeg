<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class ManageInvites extends Model
{
    protected $table = 'admin_user_invites';
    protected $fillable = [
        'name', 'email','account_type', 'message', 'status', 'created_date', 'approved_date','is_blocked','password',
    ];
	public $timestamps = false;
}
