<?php

namespace App\Controller;

use App\Entity\FormChampsOption;
use App\Form\FormChampsOptionType;
use App\Repository\FormChampsOptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/form/champs/option')]
class FormChampsOptionController extends AbstractController
{
    #[Route('/', name: 'app_form_champs_option_index', methods: ['GET'])]
    public function index(FormChampsOptionRepository $formChampsOptionRepository): Response
    {
        return $this->render('form_champs_option/index.html.twig', [
            'form_champs_options' => $formChampsOptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_champs_option_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formChampsOption = new FormChampsOption();
        $form = $this->createForm(FormChampsOptionType::class, $formChampsOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formChampsOption);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_champs_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_champs_option/new.html.twig', [
            'form_champs_option' => $formChampsOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_champs_option_show', methods: ['GET'])]
    public function show(FormChampsOption $formChampsOption): Response
    {
        return $this->render('form_champs_option/show.html.twig', [
            'form_champs_option' => $formChampsOption,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_champs_option_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormChampsOption $formChampsOption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormChampsOptionType::class, $formChampsOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_champs_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_champs_option/edit.html.twig', [
            'form_champs_option' => $formChampsOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_champs_option_delete', methods: ['GET'])]
    public function delete(Request $request, FormChampsOption $formChampsOption, EntityManagerInterface $entityManager): Response
    {
      //  if ($this->isCsrfTokenValid('delete'.$formChampsOption->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formChampsOption);
            $entityManager->flush();
     //   }

        return $this->redirectToRoute('app_form_champs_option_index', [], Response::HTTP_SEE_OTHER);
    }
}
