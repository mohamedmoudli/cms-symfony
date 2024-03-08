<?php

namespace App\Controller;

use App\Entity\FormEtat;
use App\Entity\FormEtatVariable;
use App\Form\FormEtatType;
use App\Repository\FormEtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/etat')]
class FormEtatController extends AbstractController
{
    #[Route('/', name: 'app_form_etat_index', methods: ['GET'])]
    public function index(FormEtatRepository $formEtatRepository): Response
    {
        return $this->render('form_etat/index.html.twig', [
            'form_etats' => $formEtatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_etat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formEtat = new FormEtat();
        $form = $this->createForm(FormEtatType::class, $formEtat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formEtat);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_etat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_etat/new.html.twig', [
            'form_etat' => $formEtat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_etat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormEtat $formEtat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormEtatType::class, $formEtat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_etat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_etat/edit.html.twig', [
            'form_etat' => $formEtat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_etat_delete', methods: ['GET'])]
    public function delete(Request $request, FormEtat $formEtat, EntityManagerInterface $entityManager): Response
    {
        $formEtatVariables = $entityManager->getRepository(FormEtatVariable::class)->findBy(['formEtat'=>$formEtat->getId()]);
        foreach ($formEtatVariables as $formEtatVariable){
            $entityManager->remove($formEtatVariable);
            $entityManager->flush();
        }
      //  if ($this->isCsrfTokenValid('delete'.$formEtat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formEtat);
            $entityManager->flush();
     //   }

        return $this->redirectToRoute('app_form_etat_index', [], Response::HTTP_SEE_OTHER);
    }
}
