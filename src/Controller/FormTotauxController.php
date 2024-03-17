<?php

namespace App\Controller;

use App\Entity\FormTotaux;
use App\Entity\Projet;
use App\Form\FormTotauxType;
use App\Repository\FormTotauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/totaux')]
class FormTotauxController extends AbstractController
{
    #[Route('/', name: 'app_form_totaux_index', methods: ['GET'])]
    public function index(FormTotauxRepository $formTotauxRepository): Response
    {
        return $this->render('form_totaux/index.html.twig', [
            'form_totauxes' => $formTotauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_totaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formTotaux = new FormTotaux();
        $form = $this->createForm(FormTotauxType::class, $formTotaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $request->getSession();
            $projet = $entityManager->getRepository(Projet::class)->findOneBy(['id'=>$session->get('projetId')]);
            $formTotaux->setProjet($projet);
            $entityManager->persist($formTotaux);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_totaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_totaux/new.html.twig', [
            'form_totaux' => $formTotaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_totaux_show', methods: ['GET'])]
    public function show(FormTotaux $formTotaux): Response
    {
        return $this->render('form_totaux/show.html.twig', [
            'form_totaux' => $formTotaux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_totaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormTotaux $formTotaux, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormTotauxType::class, $formTotaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_totaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_totaux/edit.html.twig', [
            'form_totaux' => $formTotaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_totaux_delete', methods: ['POST'])]
    public function delete(Request $request, FormTotaux $formTotaux, EntityManagerInterface $entityManager): Response
    {
       // if ($this->isCsrfTokenValid('delete'.$formTotaux->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formTotaux);
            $entityManager->flush();
      //  }

        return $this->redirectToRoute('app_form_totaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
