<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TasksBlue extends Model {

    /**
     * Generated
     */

    protected $table = 'tasks_blues';
    protected $fillable = ['id', 'TaskName', 'TaskName1', 'TaskType', 'shift_id', 'active_for_current_show', 'PermanentTask'];



}
