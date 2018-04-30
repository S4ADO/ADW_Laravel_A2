<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use File;
use Session;
use Auth;

class SettingsController extends Controller
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
     * Show settings menu
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = "";
        return view('settings', compact('info'));
    }

    /**
     * Returns the statistics view
     * calculates releavent stats
     * @return \Illuminate\Http\Response
     */
    public function statistics()
    {
        $iTotalTasks = 0;
        $iCompletedTasks = 0;
        $iIncompletedTasks = 0;
        $iIncompletedTasksPastDate = 0;

        $tasks = Task::getTasks("");
        //All tasks
        foreach($tasks as $task)
        {
            $iTotalTasks++;
        }

        $tasks = Task::getCompleteTasks("false");
        $notCompleteImportanceInfo[0] = 0;
        $notCompleteImportanceInfo[1] = 0;
        $notCompleteImportanceInfo[2] = 0;
        $notCompleteImportanceInfo[3] = 0;
        $notCompleteImportanceInfo[4] = 0;
        $notCompleteImportanceInfo[5] = 0;
        //Tasks which aren't completed and their importance value
        foreach($tasks as $task)
        {
            $notCompleteImportanceInfo[$task->importanceid]++;
            $iIncompletedTasks++;
        }

        $tasks = Task::getCompleteTasks("true");
        $completeImportanceInfo[0] = 0;
        $completeImportanceInfo[1] = 0;
        $completeImportanceInfo[2] = 0;
        $completeImportanceInfo[3] = 0;
        $completeImportanceInfo[4] = 0;
        $completeImportanceInfo[5] = 0;
        //Tasks which are completed and their importance value
        foreach($tasks as $task)
        {
            $completeImportanceInfo[$task->importanceid]++;
            $iCompletedTasks++;
        }

        $tasks = Task::getCompleteTasks("");
        $completeImportanceDateInfo[0] = 0;
        $completeImportanceDateInfo[1] = 0;
        $completeImportanceDateInfo[2] = 0;
        $completeImportanceDateInfo[3] = 0;
        $completeImportanceDateInfo[4] = 0;
        $completeImportanceDateInfo[5] = 0;
        //Tasks which are incomplete and past their complete date
        foreach($tasks as $task)
        {
            $completeImportanceDateInfo[$task->importanceid]++;
            $iIncompletedTasksPastDate++;
        }

        return view('statistics', compact('notCompleteImportanceInfo',
          'completeImportanceInfo', 
          'completeImportanceDateInfo',
          'iTotalTasks',
          'iCompletedTasks',
          'iIncompletedTasks',
          'iIncompletedTasksPastDate'));
    }

    /**
     * Returns the avatar view
     *
     * @return \Illuminate\Http\Response
     */
    public function avatar()
    {
        $info = "";
        return view('avatar', compact('info'));
    }

    /**
     * 
     * Uploads user submitted avatar to the server
     */
    public function avatarpost()
    {
        //Check to make sure correct file format is used
        if(request()->avatarin->getClientOriginalExtension() != "jpeg" && 
            request()->avatarin->getClientOriginalExtension() != "gif" &&
            request()->avatarin->getClientOriginalExtension() != "png" &&
            request()->avatarin->getClientOriginalExtension() != "jpg")
        {
            Session::flash('message', 'Allowed file formats are: jpg, gif, png and jpeg. You must use one of them'); 
            return view('avatar');
        }
        elseif(request()->avatarin->getClientSize() > 200000)//If filesize is more than 2MB
        {
            Session::flash('message', 'File size must be smaller than 2MB'); 
            return view('avatar');
        }
        else
        {
            $photoName = Auth::user()->name.'.'.request()->avatarin->getClientOriginalExtension();
            request()->avatarin->move(public_path('avatars'), $photoName);
            User::setImage(Auth::user()->id, $photoName);
            Session::flash('message','Avatar added successfully'); 
            return redirect('/settings/avatar');
        }
    }

     /**
     * 
     * Deletes the user image if exists
     */
    public function avatarDelete()
    {
        $picName = User::deleteImage(Auth::user()->id);
        File::delete($picName);
        Session::flash('message','Avatar deleted successfully'); 
        return redirect('/settings/avatar');
    }
}
