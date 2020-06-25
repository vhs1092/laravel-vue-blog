<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
