<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    /**
     * Generated
     */

    protected $table = 'users';
    protected $fillable = [
	'name',
	'email',
	'password',
	'remember_token',
	'created_at',
	'updated_at',
	];

}
