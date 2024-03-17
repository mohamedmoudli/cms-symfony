<?php

namespace App\Controller;

use App\Entity\MonetiqueVariable;
use App\Form\MonetiqueVariableType;
use App\Repository\MonetiqueVariableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monetique/variable')]
class MonetiqueVariableController extends AbstractController
{
    #[Route('/', name: 'app_monetique_variable_index', methods: ['GET'])]
    public function index(MonetiqueVariableRepository $monetiqueVariableRepository): Response
    {
        return $this->render('monetique_variable/index.html.twig', [
            'monetique_variables' => $monetiqueVariableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monetique_variable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monetiqueVariable = new MonetiqueVariable();
        $form = $this->createForm(MonetiqueVariableType::class, $monetiqueVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($monetiqueVariable);
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_variable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_variable/new.html.twig', [
            'monetique_variable' => $monetiqueVariable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monetique_variable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MonetiqueVariable $monetiqueVariable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonetiqueVariableType::class, $monetiqueVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_variable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_variable/edit.html.twig', [
            'monetique_variable' => $monetiqueVariable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monetique_variable_delete', methods: ['POST'])]
    public function delete(Request $request, MonetiqueVariable $monetiqueVariable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monetiqueVariable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($monetiqueVariable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monetique_variable_index', [], Response::HTTP_SEE_OTHER);
    }
}
