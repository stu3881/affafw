<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_blue extends Model {

    /**
     * Generated
     */

    protected $table = 'users_blues';
    protected $fillable = [
	'firstname',
	'lastname',
	'email',
	'password',
	'telephone',
	'admin',
	'remember_token',
	'created_at',
	'updated_at',
	];

}
