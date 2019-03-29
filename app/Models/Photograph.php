<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photograph extends Model {

    /**
     * Generated
     */

    protected $table = 'photographs';
    protected $fillable = ['photoid', 'photogid', 'showid', 'date', 'directory', 'filename', 'comment', 'artistid1', 'artistid2'];



}
