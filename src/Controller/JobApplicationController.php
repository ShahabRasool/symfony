<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Candidate;
use App\Entity\JobApplication;
use App\Form\JobApplicationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

final class JobApplicationController extends AbstractController
{
    #[Route('/job/application/new', name: 'app_job_application_new')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form= $this->createForm(JobApplicationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data =$form->getData();
            // dd($data);
            $job =$data['job'];
            $candidate= $data['candidate'];
            $job->addCandidate($candidate);
            $entityManager->persist($job);
            $entityManager->flush();
            $this->addFlash('success', "You have successful applied for this job");
            return $this->redirectToRoute('app_job_application_new');
            
        }
        return $this->render('job_application/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/job/application/cover', name: 'app_job_application_cover')]
    public function cover(Request $request, EntityManagerInterface $entityManager): Response
    {
        $job = new Job;
        $job->setTitle('UI/UX');
        $job->setDescription('We are looking for a skilled Designer to join our team');
        $job->setIssDate(new \DateTimeImmutable('2025-02-01'));
        $job->setLastDate(new \DateTimeImmutable('2025-03-05'));
        $entityManager->persist($job);

        $candidate = new Candidate;
        $candidate->setName("Hamza");
        $candidate->setAddress("Texila");
        $candidate->setFathername("M.Hamza khan");
        $candidate->setEmail("hamza@gmail");
        $entityManager->persist($candidate);

        $jobApplication= new JobApplication;
        $jobApplication->setCoverletter("Dear sir i need this job ");
        $jobApplication->setCandidate($candidate);
        $jobApplication->setJob($job);
        $entityManager->persist($jobApplication);
        $entityManager->flush();


        return new Response('New Application Added');

    }
  
}
