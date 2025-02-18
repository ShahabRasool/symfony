<?php

namespace App\Controller;

use App\Entity\Emploee;
use App\Form\EmploeeType;
use App\Repository\EmploeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/emploee')]
final class EmploeeController extends AbstractController
{
    #[Route(name: 'app_emploee_index', methods: ['GET'])]
    public function index(EmploeeRepository $emploeeRepository): Response
    {
        return $this->render('emploee/index.html.twig', [
            'emploees' => $emploeeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_emploee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $emploee = new Emploee();
        $form = $this->createForm(EmploeeType::class, $emploee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emploee);
            $entityManager->flush();

            return $this->redirectToRoute('app_emploee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emploee/new.html.twig', [
            'emploee' => $emploee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emploee_show', methods: ['GET'])]
    public function show(Emploee $emploee): Response
    {
        return $this->render('emploee/show.html.twig', [
            'emploee' => $emploee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_emploee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Emploee $emploee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmploeeType::class, $emploee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_emploee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emploee/edit.html.twig', [
            'emploee' => $emploee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emploee_delete', methods: ['POST'])]
    public function delete(Request $request, Emploee $emploee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emploee->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($emploee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_emploee_index', [], Response::HTTP_SEE_OTHER);
    }
}
