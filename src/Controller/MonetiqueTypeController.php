<?php

namespace App\Controller;

use App\Entity\MonetiqueType;
use App\Form\MonetiqueTypeType;
use App\Repository\MonetiqueTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monetique/type')]
class MonetiqueTypeController extends AbstractController
{
    #[Route('/', name: 'app_monetique_type_index', methods: ['GET'])]
    public function index(MonetiqueTypeRepository $monetiqueTypeRepository): Response
    {
        return $this->render('monetique_type/index.html.twig', [
            'monetique_types' => $monetiqueTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monetique_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monetiqueType = new MonetiqueType();
        $form = $this->createForm(MonetiqueTypeType::class, $monetiqueType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($monetiqueType);
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_type/new.html.twig', [
            'monetique_type' => $monetiqueType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monetique_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MonetiqueType $monetiqueType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonetiqueTypeType::class, $monetiqueType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monetique_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monetique_type/edit.html.twig', [
            'monetique_type' => $monetiqueType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monetique_type_delete', methods: ['POST'])]
    public function delete(Request $request, MonetiqueType $monetiqueType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monetiqueType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($monetiqueType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monetique_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
