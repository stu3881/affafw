<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nerd extends Model {

    /**
     * Generated
     */

    protected $table = 'nerds';
    protected $fillable = ['id', 'name', 'email', 'nerd_level'];



}
