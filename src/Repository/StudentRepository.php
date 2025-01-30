<?php

namespace App\Repository;

use Psr\Log\LoggerInterface;

class StudentRepository{
    public function __construct(private LoggerInterface $looger)
    {
        
    }
    private array $students=[
        5=> "bilal",
        10=> "ahmed",
        1=> "ali",
    ];
    public function getStudents(){
        $this->looger->info("we are accessing the logger from the repository class");
        return $this->students;
    }
    public function setStudents($id){
        $this->students[$id];
    }
}