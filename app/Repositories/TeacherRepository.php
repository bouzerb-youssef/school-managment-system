<?php

namespace App\Repositories;
use App\Interfaces\TeacherRepositoryInterface;

use App\Models\Teacher;

class TeacherRepository implements TeacherRepositoryInterface{

  public function getAllTeachers(){
      return "the is teacher repository";
      return Teacher::all();
  }

}