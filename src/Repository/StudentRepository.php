<?php

namespace App\Repository;

class StudentRepository{
    private array $students=[
        5=> "bilal",
        10=> "ahmed",
        1=> "ali",
    ];
    public function getStudents(){
        return $this->students;
    }
    public function setStudents($id){
        $this->students[$id];
    }
}