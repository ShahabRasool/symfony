<?php

namespace App\Controller;

use App\Entity\Citizen;
use App\Form\CitizenType;
use App\Repository\CitizenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/citizen')]
final class CitizenController extends AbstractController
{
    #[Route(name: 'app_citizen_index', methods: ['GET'])]
    public function index(CitizenRepository $citizenRepository): Response
    {
        return $this->render('citizen/index.html.twig', [
            'citizens' => $citizenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_citizen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $citizen = new Citizen();
        $form = $this->createForm(CitizenType::class, $citizen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($citizen);
            $entityManager->flush();

            return $this->redirectToRoute('app_citizen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('citizen/new.html.twig', [
            'citizen' => $citizen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_citizen_show', methods: ['GET'])]
    public function show(Citizen $citizen): Response
    {
        return $this->render('citizen/show.html.twig', [
            'citizen' => $citizen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_citizen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Citizen $citizen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CitizenType::class, $citizen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_citizen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('citizen/edit.html.twig', [
            'citizen' => $citizen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_citizen_delete', methods: ['POST'])]
    public function delete(Request $request, Citizen $citizen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$citizen->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($citizen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_citizen_index', [], Response::HTTP_SEE_OTHER);
    }
}
