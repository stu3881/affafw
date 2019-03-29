<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewShow extends Model {

    /**
     * Generated
     */

    protected $table = 'new_show';
    protected $fillable = ['id', 'maillist_index', 'tasks_index', 'record_type', 'date', 'show_volunteer_link', 'show_run_mode', 'demo_mode_last_refreshed_date', 'length', 'title', 'artist', '1st_shift_start', '2nd_shift_start', '3rd_shift_start', 'first_shift_start', 'second_shift_start', 'third_shift_start', 'chair_setup_start', 'chair_setup_end', 'venue_index'];



}
