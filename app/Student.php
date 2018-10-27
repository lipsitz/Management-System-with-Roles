<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey='StudentID';
    public $timestamps = true;


        public function courses(){

        return $this->belongsToMany('App\Course','course_student','student_StudentID','course_CourseID');
    }
}

