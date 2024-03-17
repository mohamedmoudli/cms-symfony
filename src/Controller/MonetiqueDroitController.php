<?php

namespace App\Controller;

use App\Entity\MonetiqueDroit;
use App\Entity\Projet;
use App\Form\MonetiqueDroitType;
use App\Repository\MonetiqueDroitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monetique/droit')]
class MonetiqueDroitController extends AbstractController
{
    #[Route('/', name: 'app_monetique_droit_index', methods: ['GET'])]
    public function index(MonetiqueDroitRepository $monetiqueDroitRepository): Response
    {
        return $this->render('monetique_droit/index.html.twig', [
            'monetique_droits' => $monetiqueDroitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monetique_droit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monetiqueDroit = new MonetiqueDroit();
        $form = $this->createForm(MonetiqueDroitType::class, $monetiqueDroit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $request->getSession();
            $projet = $entityManager->getRepository(Projet::class)->findOneBy(['id'=>$session->get('projetId')]);
            $monetiqueDroit->setProjet($projet);
            $entityManager->persist($monetiqueDroit);
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_droit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_droit/new.html.twig', [
            'monetique_droit' => $monetiqueDroit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monetique_droit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MonetiqueDroit $monetiqueDroit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonetiqueDroitType::class, $monetiqueDroit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_droit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_droit/edit.html.twig', [
            'monetique_droit' => $monetiqueDroit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monetique_droit_delete', methods: ['POST'])]
    public function delete(Request $request, MonetiqueDroit $monetiqueDroit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monetiqueDroit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($monetiqueDroit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monetique_droit_index', [], Response::HTTP_SEE_OTHER);
    }
}
