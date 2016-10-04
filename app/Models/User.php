<?php


namespace AndroidIM\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';


    protected $fillable = [
        'email',
        'name',
        'password',
    ];

}
 
 