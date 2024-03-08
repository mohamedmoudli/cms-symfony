<?php

namespace App\Controller;

use App\Entity\FormStep;
use App\Entity\FormStepChamps;
use App\Form\FormStepType;
use App\Repository\FormStepRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/step')]
class FormStepController extends AbstractController
{
    #[Route('/', name: 'app_form_step_index', methods: ['GET'])]
    public function index(FormStepRepository $formStepRepository): Response
    {
        return $this->render('form_step/index.html.twig', [
            'form_steps' => $formStepRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_step_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formStep = new FormStep();
        $form = $this->createForm(FormStepType::class, $formStep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formStep);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_step_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_step/new.html.twig', [
            'form_step' => $formStep,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_step_show', methods: ['GET'])]
    public function show(FormStep $formStep): Response
    {
        return $this->render('form_step/show.html.twig', [
            'form_step' => $formStep,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_step_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormStep $formStep, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormStepType::class, $formStep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_step_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_step/edit.html.twig', [
            'form_step' => $formStep,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_step_delete', methods: ['GET'])]
    public function delete(Request $request, FormStep $formStep, EntityManagerInterface $entityManager): Response
    {
        $formStepChamps = $entityManager->getRepository(FormStepChamps::class)->findBy(['formStep'=>$formStep->getId()]);
        foreach ($formStepChamps as $formStepChamp){
            $entityManager->remove($formStepChamp);
            $entityManager->flush();
        }
      //  if ($this->isCsrfTokenValid('delete'.$formStep->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formStep);
            $entityManager->flush();
      //  }

        return $this->redirectToRoute('app_form_edit', ['id' => $formStep->getForm()->getId()], Response::HTTP_SEE_OTHER);
    }
}
