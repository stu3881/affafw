<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model {

    /**
     * Generated
     */

    protected $table = 'venue';
    protected $fillable = ['venue_index', 'venue_name', 'venue_link', 'venue_local', 'venue_height', 'venue_width'];



}
