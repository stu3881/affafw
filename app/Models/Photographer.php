<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photographer extends Model {

    /**
     * Generated
     */

    protected $table = 'photographers';
    protected $fillable = ['id', 'firstname', 'lastname', 'middlename', 'url', 'active'];



}
