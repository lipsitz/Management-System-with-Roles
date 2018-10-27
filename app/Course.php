<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    
    protected $primaryKey = 'CourseID';

    public $timestamps = true;

        public function students(){

        return $this->belongsToMany('App\Student','course_student','course_CourseID','student_StudentID');
    }
}
