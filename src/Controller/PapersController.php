<?php

namespace App\Controller;

use App\Entity\Papers;
use App\Form\PapersType;
use App\Repository\PapersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/papers')]
final class PapersController extends AbstractController
{
    #[Route(name: 'app_papers_index', methods: ['GET'])]
    public function index(PapersRepository $papersRepository): Response
    {
        return $this->render('papers/index.html.twig', [
            'papers' => $papersRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_papers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $paper = new Papers();
        $form = $this->createForm(PapersType::class, $paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($paper);
            $entityManager->flush();

            return $this->redirectToRoute('app_papers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('papers/new.html.twig', [
            'paper' => $paper,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_papers_show', methods: ['GET'])]
    // public function show(Papers $paper): Response
    // {
    //     return $this->render('papers/show.html.twig', [
    //         'paper' => $paper,
    //     ]);
    // }

    #[Route('/{slug}', name: 'app_papers_show_slug', methods: ['GET'])]
    public function slugshow(#[MapEntity(mapping: ['slug' =>'slug'])] Papers $paper): Response
    {
        return $this->render('/papers/show.html.twig', [
            'paper' => $paper,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_papers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Papers $paper, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PapersType::class, $paper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_papers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('papers/edit.html.twig', [
            'paper' => $paper,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_papers_delete', methods: ['POST'])]
    public function delete(Request $request, Papers $paper, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paper->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($paper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_papers_index', [], Response::HTTP_SEE_OTHER);
    }
}
