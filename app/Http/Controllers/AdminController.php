<?php namespace App\Http\Controllers;

use App\Municipio;
use App\Departamento;

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
        return \Redirect::route('login');
    }

}