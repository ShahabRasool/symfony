<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Attribute\Route;

class HelloController{
    #[Route('/welcome/{name}', name: "welcomeRouter")] 
    public function welcome( string $name){
        return new Response('Welcome to Symfony ' . $name );
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