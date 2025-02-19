<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Attribute\Route;

#[Route('/teacher')]
class TeacherController extends AbstractController{

    #[Route('/showall', name: "teacher_showall")]
    public function showall(TeacherRepository $teacherRepository, Request $request){
        $teachers = $teacherRepository->findAllwithPaginationSupport();
        $teachers->setMaxPerPage(2);
        $teachers->setCurrentPage($request->query->get('page',1));
        return $this->render('teacher/showall.html.twig', ['teachers' => $teachers]);
        }

        // to show one record

        #[Route('/show/{id<\d+>}', name: "teacher_show_one")]
        public function showOne(TeacherRepository $teacherRepository,  $id){
            $teacher = $teacherRepository->find($id);
            return $this->render('teacher/showone.html.twig', ['teacher' => $teacher]);
            }
// this will add a recod in the table
        #[Route('/new', name: "teacher_new")]
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
    #[Route('/update/{id<\d+>}', name: "teacher_update")]
    public function update(TeacherRepository $teacherRepository, $id){
    $teacher= $teacherRepository->find($id);
    $teacher->setName("Azmat Shah");
    $teacher->setFatherName("Azmat_Shah");

    $teacherRepository->add($teacher, true);

            return $this->render('teacher/update.html.twig', ['teacher' => $teacher]);
            }

// delete the record
            #[Route('/delete/{id<\d+>}', name: "teacher_delete")]
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


                //  This is  we will create a form`
            #[Route('/create')]
            public function create( Request $request, TeacherRepository $teacherRepository) : Response{
                $teacher = new Teacher;
        $form =$this->createFormBuilder($teacher)
                ->add('name', TextType::class)
                ->add('father_name',TextType::class)
                ->add('email', EmailType::class)
                ->add('address', TextareaType::class)
                ->add('phone', TextType::class)
                ->add('d_b_birth', DateTimeType::class)
                ->add('save', SubmitType::class, ['label' => 'Add Teacher'])
                ->getForm();
                $form->handleRequest($request);
                // dd($form->getData());
                if($form->isSubmitted() && $form->isValid()){
                    // $formdata=$form->getData();
                    $teacherRepository->add($teacher, true);
                    $this->addFlash('success', "The teacher <strong class='text-green-600 text-5xl font-bold'>{$teacher->getName()}</strong> has been add successfull add.");
                    return $this->redirectToRoute('teacher_showall');
                }
                return $this->render('teacher/create.html.twig',['form'=>$form]);
            }

            #[Route('/create/class', name: 'teacher_create_class')]
            public function createClass(Request $request, TeacherRepository $teacherRepository): Response{
                $teacher = new Teacher;
                $form = $this->createForm(TeacherType::class);
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    // $formdata=$form->getData();
                    $teacherRepository->add($teacher, true);
                    $this->addFlash('success', "The teacher <strong class='text-green-600 text-5xl font-bold'>{$teacher->getName()}</strong> has been add successfull add.");
                    return $this->redirectToRoute('teacher_showall');
                }
                return $this->render('teacher/createclass.html.twig',['form'=>$form]);
            }
}