<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Course;
class StudentsController extends Controller
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
        // $student= Student::all();
        return view ('pages.students.allstudents');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('pages.students.addstudent');
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
            'StudentName'=>'required',
            'StudentEmail'=>'required',
            'StudentPhone'=>'required',
            'StudentLogo'=>'image|nullable|max:1999',

            ]);
            
            // ---Handle File---

            if($request->hasFile('StudentLogo')){
                // Get file name with the extension
                $filenameWithExt = $request->file('StudentLogo')->getClientOriginalName();
                // get just file name
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                // get the extension
                $extension = $request->file('StudentLogo')->getClientOriginalExtension();
                // file name to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // upload image
                $path = $request->file('StudentLogo')->storeAs('public/studentsimages',$fileNameToStore);
                
            }else{

                $fileNameToStore= 'noimage.jpg';
            }
           
           
           
            // create New Student---
        $student= new Student;
        $student->StudentName=$request->input('StudentName');
        $student->StudentEmail=$request->input('StudentEmail');
        $student->StudentPhone=$request->input('StudentPhone');
        $student->StudentLogo=$fileNameToStore;
        $student->save();
        $student->courses()->sync($request->courses,false);
      
        return redirect('/students')->with('success','Student Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=Student::find($id);
        return view('pages.students.show')->with('student',$student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::find($id);
        $studentCourses=$student->courses;
        $edit=true;
        $studentId = $id;
        $courses2=array();
        foreach ($studentCourses as $studentCourse){
           $courses2[] = $studentCourse->CourseID; 
        }      
        return view('pages.students.editstudent')->with('student',$student)->with('courses2', $courses2);
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
        $this->validate($request,[
            'StudentName'=>'required',
            'StudentEmail'=>'required',
            'StudentPhone'=>'required',
            'StudentLogo'=>'image|nullable|max:1999',

            ]);
            $student=Student::find($id);
             // ---Handle File---

             if($request->hasFile('StudentLogo')){
                // Get file name with the extension
                $filenameWithExt = $request->file('StudentLogo')->getClientOriginalName();
                // get just file name
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                // get the extension
                $extension = $request->file('StudentLogo')->getClientOriginalExtension();
                // file name to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // upload image
                $path = $request->file('StudentLogo')->storeAs('public/studentsimages',$fileNameToStore);
                
            }else{

                $fileNameToStore= $student->StudentLogo;
            }
            
            // create New Student---
        $student->StudentName=$request->input('StudentName');
        $student->StudentEmail=$request->input('StudentEmail');
        $student->StudentPhone=$request->input('StudentPhone');
        $student->StudentLogo=$fileNameToStore;
        $student->save();
        if(isset($request->courses)){
            $student->courses()->sync($request->courses);
        }else{ 
            $student->courses()->sync(array());
        }
        return redirect('/students')->with('success','Student Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        $student->courses()->detach();

        return redirect('/students')->with('success','Student Deleted Successfully');
    }
}
