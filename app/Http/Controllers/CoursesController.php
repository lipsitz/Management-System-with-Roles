<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;
use App\Course;
class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
        
            
    }
    public function index()
    {  
        $course= Course::all();
        return view ('pages.courses.allcourses')->with('course',$course);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role =='sale'){
            return redirect('/')->with('error','Unauthorized Page') ;
        }else{
            return view ('pages.courses.addcourse');
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // validation---
        $this->validate($request,[
            'CourseName'=>'required',
            'CourseInfo'=>'required',
            'CourseLogo'=>'image|nullable|max:1999',


    ]);

 // ---Handle File---

 if($request->hasFile('CourseLogo')){
    // Get file name with the extension
    $filenameWithExt = $request->file('CourseLogo')->getClientOriginalName();
    // get just file name
    $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
    // get the extension
    $extension = $request->file('CourseLogo')->getClientOriginalExtension();
    // file name to store
    $fileNameToStore = $filename.'_'.time().'.'.$extension;
    // upload image
    $path = $request->file('CourseLogo')->storeAs('public/coursesimages',$fileNameToStore);
    
}else{

    $fileNameToStore= 'noimage.jpg';
}

    // create Course---
        $course= new Course;
        $course->CourseName=$request->input('CourseName');
        $course->CourseInfo=$request->input('CourseInfo');
        $course->CourseLogo=$fileNameToStore;
        $course->save();
        return redirect('/courses')->with('success','Course Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course=Course::find($id);
        return view('pages.courses.show')->with('course',$course);
        // return view('pages.courses.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // Authentiction-------
        if(auth()->user()->role =='sale'){
            return redirect('/')->with('error','Unauthorized Page') ;
        }else{
            $course=Course::find($id);
            return view('pages.courses.editcourse')->with('course',$course);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // validation---
        $this->validate($request,[
            'CourseName'=>'required',
            'CourseInfo'=>'required',
            'CourseLogo'=>'image|nullable|max:1999',


    ]);
    $course=Course::find($id);
    // ---Handle File---

 if($request->hasFile('CourseLogo')){
    // Get file name with the extension
    $filenameWithExt = $request->file('CourseLogo')->getClientOriginalName();
    // get just file name
    $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
    // get the extension
    $extension = $request->file('CourseLogo')->getClientOriginalExtension();
    // file name to store
    $fileNameToStore = $filename.'_'.time().'.'.$extension;
    // upload image
    $path = $request->file('CourseLogo')->storeAs('public/coursesimages',$fileNameToStore);
    
}else{
    
    $fileNameToStore = $course->CourseLogo;
}
    // updated course
        $course->CourseName=$request->input('CourseName');
        $course->CourseInfo=$request->input('CourseInfo');
        $course->CourseLogo=$fileNameToStore;
        $course->save();
        return redirect('/courses')->with('success','Course Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Authentiction-------
        if(auth()->user()->role =='sale'){
            return redirect('/')->with('error','Unauthorized Action') ;
        }else{
           
        // Destroy------
        $course=Course::find($id);
        $course->delete();
        $course->students()->detach();
        return redirect('/courses')->with('success','Course Deleted Successfully');
        }
    }
    }  
