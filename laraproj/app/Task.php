<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Task extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'comple_date', 'userid',
    ];

    /**
    *   Returns an array of all of the tasks for the current user
    */
    public static function searchTasks($searchString)
    {
        $tasks = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid')
        ->where('userid', '=', Auth::user()->id)
        ->where('body', 'LIKE', "%{$searchString}%")
        ->select('tasks.*', 'importance.importance')
        ->get();
        return $tasks;
    }


    /**
    *	Returns an array of all of the tasks for the current user
    */
    public static function getTasks($orderBy)
    {
        if($orderBy == "")
        {
            $tasks = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid')
            ->where('userid', '=', Auth::user()->id)
            ->select('tasks.*', 'importance.importance')
            ->orderByRaw('id DESC')
            ->get();
        }
        else
        {
            $tasks = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid')
            ->where('userid', '=', Auth::user()->id)
            ->select('tasks.*', 'importance.importance')
            ->orderByRaw($orderBy)
            ->get();
        }
    	return $tasks;
    }

    /**
    * Returns a specified task owned by current user
    */
    public static function getTask($taskID)
    {
    	$task = DB::table('tasks')->where('userid', '=', Auth::user()->id)
    	->where('id', '=', $taskID)
    	->first();
    	return $task;
    }

    /**
    * Returns a boolean true if the selected task exists for the current user
    */
    public static function checkIfTaskExistsForCurrentUser($taskID)
    {
    	if(Task::where('id', '=', $taskID)->where('userid', '=', Auth::user()->id)->exists()) 
    	{
  			return true;
		}
		else
		{
			return false;
		}
    }
}
