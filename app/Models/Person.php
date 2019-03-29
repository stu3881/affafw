<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    /**
     * Generated
     */

    protected $table = 'people';
    protected $fillable = ['Id', 'FirstName', 'LastName', 'BirthDate', 'Gender', 'Done'];



}
