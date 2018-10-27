<?php

namespace App\Http\Controllers;
use App\Course;
use App\Student;

use Illuminate\Http\Request;

class PagesController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){


        return view('pages.index');
    }
    public function admin(){
        if(auth()->user()->role =='sale'){
            return redirect('/')->with('error','Unauthorized Page');
        }
              else{
                return view('pages.adminpage');
              }
      
    }
}
