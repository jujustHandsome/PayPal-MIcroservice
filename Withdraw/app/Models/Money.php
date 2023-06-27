<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;


class Money extends Model {

    public $timestamps = false;

    protected $table = 'users';

    protected $fillable = [
        'id', 'money'
    ];

    protected $hidden =[
        "password"
    ];
}