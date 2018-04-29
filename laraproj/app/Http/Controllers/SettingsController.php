<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
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

    //Returns the avatar view
    public function avatar()
    {
        $info = "";
        return view('avatar', compact('info'));
    }

    //Uploads the user inputted image to the server
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
        else
        {
            $photoName = Auth::user()->name.'.'.request()->avatarin->getClientOriginalExtension();
            request()->avatarin->move(public_path('avatars'), $photoName);
            User::setImage(Auth::user()->id, $photoName);
            Session::flash('message', 'Avatar added successfully'); 
            return redirect('/settings/avatar');
        }
    }
}
