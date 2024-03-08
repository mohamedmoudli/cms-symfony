<?php

namespace App\Controller;

use App\Entity\FormStepChamps;
use App\Form\FormStepChampsType;
use App\Repository\FormStepChampsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/step/champs')]
class FormStepChampsController extends AbstractController
{
    #[Route('/', name: 'app_form_step_champs_index', methods: ['GET'])]
    public function index(FormStepChampsRepository $formStepChampsRepository): Response
    {
        return $this->render('form_step_champs/index.html.twig', [
            'form_step_champs' => $formStepChampsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_step_champs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formStepChamp = new FormStepChamps();
        $form = $this->createForm(FormStepChampsType::class, $formStepChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formStepChamp);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_step_champs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_step_champs/new.html.twig', [
            'form_step_champ' => $formStepChamp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_step_champs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormStepChamps $formStepChamp, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormStepChampsType::class, $formStepChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_step_champs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_step_champs/edit.html.twig', [
            'form_step_champ' => $formStepChamp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_step_champs_delete', methods: ['GET'])]
    public function delete(Request $request, FormStepChamps $formStepChamp, EntityManagerInterface $entityManager): Response
    {
       // if ($this->isCsrfTokenValid('delete'.$formStepChamp->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formStepChamp);
            $entityManager->flush();
      //  }

        return $this->redirectToRoute('app_form_step_champs_index', [], Response::HTTP_SEE_OTHER);
    }
}
