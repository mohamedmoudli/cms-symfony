<?php

namespace App\Controller;

use App\Entity\FormEtatVariable;
use App\Form\FormEtatVariableType;
use App\Repository\FormEtatVariableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/etat/variable')]
class FormEtatVariableController extends AbstractController
{
    #[Route('/', name: 'app_form_etat_variable_index', methods: ['GET'])]
    public function index(FormEtatVariableRepository $formEtatVariableRepository): Response
    {
        return $this->render('form_etat_variable/index.html.twig', [
            'form_etat_variables' => $formEtatVariableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_etat_variable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formEtatVariable = new FormEtatVariable();
        $form = $this->createForm(FormEtatVariableType::class, $formEtatVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formEtatVariable);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_etat_variable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_etat_variable/new.html.twig', [
            'form_etat_variable' => $formEtatVariable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_etat_variable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormEtatVariable $formEtatVariable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormEtatVariableType::class, $formEtatVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_etat_variable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_etat_variable/edit.html.twig', [
            'form_etat_variable' => $formEtatVariable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_etat_variable_delete', methods: ['GET'])]
    public function delete(Request $request, FormEtatVariable $formEtatVariable, EntityManagerInterface $entityManager): Response
    {
      //  if ($this->isCsrfTokenValid('delete'.$formEtatVariable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formEtatVariable);
            $entityManager->flush();
      //  }

        return $this->redirectToRoute('app_form_etat_variable_index', [], Response::HTTP_SEE_OTHER);
    }
}
