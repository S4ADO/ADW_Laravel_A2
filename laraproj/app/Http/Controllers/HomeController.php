<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Session;
use Auth;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show current tasks user has
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::getTasks();
        return view('home', compact('tasks'));
    }

    /**
     * Searches user's task bodies with given string
     */
    public function search()
    {
        $this->validate(request(), [
            'search' => 'required|min:3',
        ]);

        $searchString = request('search');
        $foundTasks = Task::searchTasks($searchString);
        return view('search', compact('foundTasks', 'searchString'));
    }

    /**
     * Redirects user to create post page
     */
    public function create()
    {
        return view('create');
    }

    /**
    * Adds a given task for the user to the daatabse
    */
    public function post()
    {
        $this->validate(request(), [
            'title' => 'required|min:3',
            'body' => 'required|min:5',
            'date' => 'required'
        ]);

        $Task = new Task();
        $Task->title = request('title');
        $Task->body = request('body');
        $Task->userid = Auth::user()->id;
        $Task->complete_date = request('date');
        $Task->save();
        Session::flash('message', 'Task added'); 
        $tasks = Task::getTasks();
        return view('home', compact('tasks'));
    }

    /**
     * Checks to make sure task exists and is owned by user
     * redirects user to edit page if task exists
     */
    public function edit($id)
    {
        if(Task::checkIfTaskExistsForCurrentUser($id))
        {
            $task = Task::getTask($id);
            return view('edit', compact('task'));
        }
        else
        {
            Session::flash('message', 'That task does not exist or is not yours!'); 
            $tasks = Task::getTasks();
            return view('home', compact('tasks'));
        }
    }

    /**
     * Edits a pre-existsing task and saves it to the database
     */
    public function editpost()
    {
        //Make sure user is editting their own task
        if(Task::checkIfTaskExistsForCurrentUser(request('taskid')))
        {
            $this->validate(request(), [
                'title' => 'required|min:3',
                'body' => 'required|min:5',
                'date' => 'required'
            ]);

            $Task = Task::find(request('taskid'));
            $Task->title = request('title');
            $Task->body = request('body');
            $Task->complete_date = request('date');
            $iCompleted = 0;
            if(!empty(request('completecb')))
            {
                 $iCompleted = 1;
            }
            $Task->complete = $iCompleted;
            $Task->save();

            Session::flash('message', 'Task updated successfully'); 
            $tasks = Task::getTasks();
            return view('home', compact('tasks'));
        }
        else
        {
            //User has tried to edit a task which is not their own
            Session::flash('message', 'That task does not belong to you or does not exist!'); 
            $tasks = Task::getTasks();
            return view('home', compact('tasks'));
        }
    }

    /**
     * Deletes a pre-existsing task
     */
    public function deletepost()
    {
        //Make sure user is deleting their own task
        if(Task::checkIfTaskExistsForCurrentUser(request('taskid')))
        {
            //Make sure we get a string as deletion ID
            $this->validate(request(), [
                'taskid' => 'required|integer',
            ]);

            $Task = Task::find(request('taskid'));
            $Task->forceDelete();

            Session::flash('message', 'Task deleted successfully'); 
            $tasks = Task::getTasks();
            return view('home', compact('tasks'));
        }
        else
        {
            //User has tried to edit a task which is not their own
            Session::flash('message', 'That task does not belong to you or does not exist!'); 
            $tasks = Task::getTasks();
            return view('home', compact('tasks'));
        }
    }
}
