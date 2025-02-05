<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\component\Routing\Attribute\Route;

class TeacherController extends AbstractController{

    #[Route('/teacher/showall', name: "teacher_showall")]
    public function showall(TeacherRepository $teacherRepository){
        $teachers = $teacherRepository->findAll();
        return $this->render('teacher/showall.html.twig', ['teachers' => $teachers]);
        }

        // to show one record

        #[Route('/teacher/show/{id<\d+>}', name: "teacher_show_one")]
        public function showOne(TeacherRepository $teacherRepository,  $id){
            $teacher = $teacherRepository->find($id);
            return $this->render('teacher/showone.html.twig', ['teacher' => $teacher]);
            }
// this will add a recod in the table
        #[Route('/teacher/new', name: "teacher_new")]
        public function new(TeacherRepository $teacherRepository,){
        $teacher= new Teacher;
        $teacher->setName("Azmat sab");
        $teacher->setFatherName("Azmat Shah");
        $teacher->setEmail("azmat@gmail.com");
        $teacher->setPhone("1234567890");
        $teacher->setAddress("Wah Texila");
        $teacher->setDBBirth(new \DateTimeImmutable('1976-01-01'));
        $teacherRepository->add($teacher, true);

                return $this->render('teacher/new.html.twig', ['teacher' => $teacher]);
                }



    // this will update the record the table
    #[Route('/teacher/update/{id<\d+>}', name: "teacher_update")]
    public function update(TeacherRepository $teacherRepository, $id){
    $teacher= $teacherRepository->find($id);
    $teacher->setName("Azmat Shah");
    $teacher->setFatherName("Azmat_Shah");

    $teacherRepository->add($teacher, true);

            return $this->render('teacher/update.html.twig', ['teacher' => $teacher]);
            }

// delete the record
            #[Route('/teacher/delete/{id<\d+>}', name: "teacher_delete")]
            public function delete(TeacherRepository $teacherRepository, $id){
            $teacher= $teacherRepository->find($id);
            if($teacher){
                $teacherRepository->remove($teacher);
            }else{
                $this->createNotFoundException("This is dose not exist");
            }
            $teacherRepository->remove($teacher);
        
                    return $this->render('teacher/delete.html.twig', ['teacher' => $teacher]);
                    }
}