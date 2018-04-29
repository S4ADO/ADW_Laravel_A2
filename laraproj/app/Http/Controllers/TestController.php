<?php

namespace App\Http\Controllers;
use DB;
use App\Task;

class TestController extends Controller
{
    public function index()
    {
        //$tasks = DB::table('tasks')->where('id', '>', 1)->where('body', 'like', '%test%')->get();
		$tasks = Task::all();
		//$taskObj->save();
	    return view('test.index', compact('tasks'));
    }

    public function show($id)
    {
    	$task = DB::table('tasks')->where('id', '=', $id)->get();
    	return view('test.show', compact('task'));
    }
}

