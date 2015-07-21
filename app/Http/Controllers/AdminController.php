<?php namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function desktop(){
        return view('desktop');
    }

    public function logout(){
        \Auth::logout();
        return \Redirect::route('login_admin');
    }

}