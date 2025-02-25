<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegController extends AbstractController
{
    #[Route('/reg', name: 'app_reg')]
    public function index(UserPasswordHasherInterface $userhasher, UserRepository $userRepository): Response
    {
        $user = new User;
        $user->setEmail('shahabrasool@gmail.com');
        $plainPassword="123456";
        $hashedPassword = $userhasher->hashPassword($user, $plainPassword);
        $userRepository->upgradePassword($user, $hashedPassword);
        return $this->render('reg/index.html.twig', [
            'user' => $user,
        ]);
    }
}
