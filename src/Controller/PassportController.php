<?php

namespace App\Controller;

use App\Entity\Passport;
use App\Form\PassportType;
use App\Repository\PassportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/passport')]
final class PassportController extends AbstractController
{
    #[Route(name: 'app_passport_index', methods: ['GET'])]
    public function index(PassportRepository $passportRepository): Response
    {
        return $this->render('passport/index.html.twig', [
            'passports' => $passportRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_passport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $passport = new Passport();
        $form = $this->createForm(PassportType::class, $passport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($passport);
            $entityManager->flush();

            return $this->redirectToRoute('app_passport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('passport/new.html.twig', [
            'passport' => $passport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_passport_show', methods: ['GET'])]
    public function show(Passport $passport): Response
    {
        return $this->render('passport/show.html.twig', [
            'passport' => $passport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_passport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Passport $passport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PassportType::class, $passport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_passport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('passport/edit.html.twig', [
            'passport' => $passport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_passport_delete', methods: ['POST'])]
    public function delete(Request $request, Passport $passport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$passport->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($passport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_passport_index', [], Response::HTTP_SEE_OTHER);
    }
}
