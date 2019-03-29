<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maillist extends Model {

    /**
     * Generated
     */

    protected $table = 'maillist';
    protected $fillable = [
	'FirstName',
	'LastName',
	'Address',
	'City',
	'State',
	'Zip',
	'Email',
	'Original_email',
	'Phone',
	'Update',
	'Status',
	'Quantity',
	'Notes',
	'Flags',
	'raffleAug2010',
	'plst1_user_user_id',
	'created_at',
	'updated_at',
	];

}
