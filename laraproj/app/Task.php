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
        'title', 'body', 'complete_date', 'userid',
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
    *   Returns all incomplete tasks
    */
    public static function getCompleteTasks($completed)
    {
        if($completed == "false")
        {
            $tasks = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid')
            ->where('userid', '=', Auth::user()->id)
            ->where('complete', '=', 0)
            ->select('tasks.*', 'importance.importance')
            ->get();
        }
        elseif($completed == "true")
        {
            $tasks = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid')
            ->where('userid', '=', Auth::user()->id)
            ->where('complete', '=', 1)
            ->select('tasks.*', 'importance.importance')
            ->get();
        }
        else
        {
            $tasks = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid')
            ->where('userid', '=', Auth::user()->id)
            ->where('complete', '=', 0)
            ->where('complete_date', '<', \Carbon\Carbon::now())
            ->select('tasks.*', 'importance.importance')
            ->get();
        }
        return $tasks;
    }

    public static function advancedSearch($request)
    {
        $query = DB::table('tasks')->join('importance', 'tasks.importanceid', '=', 'importance.importanceid');
        //Begin search
        if($request->added != "")
        {
            if($request->addedexact == "exact")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('created_at', '=', $request->added)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            elseif($request->addedexact == "more")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('created_at', '>', $request->added)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            else
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('created_at', '<', $request->added)
                ->select('tasks.*', 'importance.importance')
                ;
            }
        }


        if($request->title != "")
        {
            if(!empty($request->titleexact))
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('title', '=', $request->title)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            else
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('title', 'LIKE', "%{$request->title}%")
                ->select('tasks.*', 'importance.importance')
                ;
            }
        }


        if($request->body != "")
        {
            if(!empty($request->bodyexact))
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('body', '=', $request->body)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            else
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('body', 'LIKE', "%{$request->body}%")
                ->select('tasks.*', 'importance.importance')
                ;
            }
        }


        if(!is_null(request('importance')))
        {
            if($request->importanceexact == "exact")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('importance.importanceid', '=', $request->importance)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            elseif($request->importanceexact == "more")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('importance.importanceid', '>', $request->importance)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            else
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('importance.importanceid', '<', $request->importance)
                ->select('tasks.*', 'importance.importance')
                ;
            }
        }


        if($request->completedexact == "search")
        {
            if(!empty($request->completed))
            {
                $iToSearch = 1;
            }
            else
            {
                $iToSearch = 0;
            }
            if($request->completed == "checked")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('complete', '=', $iToSearch)
                ->select('tasks.*', 'importance.importance')
                ;
            }
            else
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('complete', '=', $iToSearch)
                ->select('tasks.*', 'importance.importance')
                ;
            }
        }
        if($request->done != "")
        {
            if($request->doneexact == "exact")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('complete_date', '=', "$request->done")
                ->select('tasks.*', 'importance.importance')
                ;
            }
            elseif($request->doneexact == "more")
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('complete_date', '>', "$request->done")
                ->select('tasks.*', 'importance.importance')
                ;
            }
            else
            {
                $query = $query
                ->where('userid', '=', Auth::user()->id)
                ->where('complete_date', '<', "$request->done")
                ->select('tasks.*', 'importance.importance')
                ;
            }
        }
        $tasks = $query->get();
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
