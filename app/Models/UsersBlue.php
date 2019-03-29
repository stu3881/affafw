<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersBlue extends Model {

    /**
     * Generated
     */

    protected $table = 'users_blues';
    protected $fillable = ['id', 'firstname', 'lastname', 'email', 'password', 'telephone', 'admin', 'remember_token'];



}
