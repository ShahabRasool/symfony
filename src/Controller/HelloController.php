<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Attribute\Route;

class HelloController extends AbstractController{
    #[Route('/welcome/{name}', name: "welcomeRouter")] 
    public function welcome( string $name){
        return $this->render('hello/welcome.html.twig' , ['name'=>$name]);
    }

    #[Route('/inform')]
    public function inform(){
        return new Response('This is a Symfony project');
        }

     
    #[Route('/multify/{a</d+>}/{b</d+>}')]
    public function multify(int $a, $b){
        $result =$a * $b;
        return new Response('The result will be ' .$result);
        }   
}
?>