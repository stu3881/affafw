<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model {

    /**
     * Generated
     */

    protected $table = 'Administrators';
    protected $fillable = [
	'userid',
	'directory_node',
	'record_type',
	'date_created',
	'last_changed',
	'directory_node_description',
	'image_database',
	'image_table',
	'image_field',
	];

}
