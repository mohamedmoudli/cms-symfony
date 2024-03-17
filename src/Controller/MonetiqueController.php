<?php

namespace App\Controller;

use App\Entity\Monetique;
use App\Form\MonetiqueType;
use App\Repository\MonetiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monetique')]
class MonetiqueController extends AbstractController
{
    #[Route('/', name: 'app_monetique_index', methods: ['GET'])]
    public function index(MonetiqueRepository $monetiqueRepository): Response
    {
        return $this->render('monetique/index.html.twig', [
            'monetiques' => $monetiqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monetique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monetique = new Monetique();
        $form = $this->createForm(MonetiqueType::class, $monetique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($monetique);
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique/new.html.twig', [
            'monetique' => $monetique,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/edit', name: 'app_monetique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Monetique $monetique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonetiqueType::class, $monetique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique/edit.html.twig', [
            'monetique' => $monetique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monetique_delete', methods: ['POST'])]
    public function delete(Request $request, Monetique $monetique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monetique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($monetique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monetique_index', [], Response::HTTP_SEE_OTHER);
    }
}
