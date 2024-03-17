<?php

namespace App\Controller;

use App\Entity\FormChamps;
use App\Entity\FormChampsOption;
use App\Entity\FormStepChamps;
use App\Entity\Projet;
use App\Form\FormChampsType;
use App\Repository\FormChampsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/form/champs')]
class FormChampsController extends AbstractController
{
    #[Route('/', name: 'app_form_champs_index', methods: ['GET'])]
    public function index(FormChampsRepository $formChampsRepository): Response
    {
        return $this->render('form_champs/index.html.twig', [
            'form_champs' => $formChampsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_champs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formChamp = new FormChamps();
        $form = $this->createForm(FormChampsType::class, $formChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $request->getSession();
            $projet = $entityManager->getRepository(Projet::class)->findOneBy(['id'=>$session->get('projetId')]);
            $formChamp->setProjet($projet);
            $entityManager->persist($formChamp);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_champs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_champs/new.html.twig', [
            'form_champ' => $formChamp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_champs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormChamps $formChamp, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormChampsType::class, $formChamp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_champs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_champs/edit.html.twig', [
            'form_champ' => $formChamp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_champs_delete', methods: ['GET'])]
    public function delete(Request $request, FormChamps $formChamp, EntityManagerInterface $entityManager): Response
    {
       // if ($this->isCsrfTokenValid('delete'.$formChamp->getId(), $request->request->get('_token'))) {
           $formChampsOptions = $entityManager->getRepository(FormChampsOption::class)->findBy(['formChamps'=>$formChamp->getId()]);
           $formStepChamps = $entityManager->getRepository(FormStepChamps::class)->findBy(['formChamps'=>$formChamp->getId()]);
            foreach ($formChampsOptions as $formChampOption){
                $entityManager->remove($formChampOption);
                $entityManager->flush();
            }
            foreach ($formStepChamps as $formStepChamp){
                  $entityManager->remove($formStepChamp);
                  $entityManager->flush();
            }
            $entityManager->remove($formChamp);
            $entityManager->flush();
     //   }

        return $this->redirectToRoute('app_form_champs_index', [], Response::HTTP_SEE_OTHER);
    }
}
