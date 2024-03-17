<?php

namespace App\Controller;

use App\Entity\MonetiqueDroitVariable;
use App\Form\MonetiqueDroitVariableType;
use App\Repository\MonetiqueDroitVariableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monetique/droit/variable')]
class MonetiqueDroitVariableController extends AbstractController
{
    #[Route('/', name: 'app_monetique_droit_variable_index', methods: ['GET'])]
    public function index(MonetiqueDroitVariableRepository $monetiqueDroitVariableRepository): Response
    {
        return $this->render('monetique_droit_variable/index.html.twig', [
            'monetique_droit_variables' => $monetiqueDroitVariableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monetique_droit_variable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monetiqueDroitVariable = new MonetiqueDroitVariable();
        $form = $this->createForm(MonetiqueDroitVariableType::class, $monetiqueDroitVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($monetiqueDroitVariable);
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_droit_variable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_droit_variable/new.html.twig', [
            'monetique_droit_variable' => $monetiqueDroitVariable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monetique_droit_variable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MonetiqueDroitVariable $monetiqueDroitVariable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonetiqueDroitVariableType::class, $monetiqueDroitVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_droit_variable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_droit_variable/edit.html.twig', [
            'monetique_droit_variable' => $monetiqueDroitVariable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monetique_droit_variable_delete', methods: ['POST'])]
    public function delete(Request $request, MonetiqueDroitVariable $monetiqueDroitVariable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monetiqueDroitVariable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($monetiqueDroitVariable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monetique_droit_variable_index', [], Response::HTTP_SEE_OTHER);
    }
}
