<?php
namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

class HelloController extends AbstractController{
    #[Route('/welcome/{name}', name: "welcomeRouter")] 
    public function welcome( string $name){
        return $this->render('hello/welcome.html.twig' , ['name'=>$name]);
    }

    #[Route('/inform-us', name: "inform")]
    public function inform(LoggerInterface $logger){
        $logger->info('This is an info message');
        return $this->render('hello/inform.html.twig');
        }

     
    #[Route('/multify/{a</d+>}/{b</d+>}')]
    public function multify(int $a, $b){
        $result =$a * $b;
        return new Response('The result will be ' .$result);
        }   


        #[Route('/getstudent')]
        public function getstudent(StudentRepository $studentsRepo){
            $students =$studentsRepo->getStudents();
            return $this->render('hello/getstudent.html.twig',['students'=>$students]);
            }
}
?>