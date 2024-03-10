<?php

namespace App\Controller;

use App\Entity\Form;
use App\Entity\FormChampsOption;
use App\Entity\FormEtat;
use App\Entity\FormEtatVariable;
use App\Entity\FormStep;
use App\Entity\FormStepChamps;
use App\Form\FormStepChampsType;
use App\Form\FormStepType;
use App\Form\FormType;
use App\Repository\FormRepository;
use App\Repository\FormStepChampsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/form')]
class FormController extends AbstractController
{
    #[Route('/', name: 'app_form_index', methods: ['GET'])]
    public function index(FormRepository $formRepository): Response
    {
        return $this->render('form/index.html.twig', [
            'forms' => $formRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_new', methods: ['GET', 'POST'])]
    public function new(FormStepChampsRepository $formStepChampsRepository ,Request $request, EntityManagerInterface $entityManager): Response
    {
        $forme = new Form();
        $formeStep = new FormStep();
        $formeStepChamps = new FormStepChamps();
        $form = $this->createForm(FormType::class, $forme);
        $formStep = $this->createForm(FormStepType::class, $formeStep);
        $form->handleRequest($request);
        $formStep->handleRequest($request);
        if ($request->getMethod() == 'GET') {
            $formStepChampsType = $this->createForm(FormStepChampsType::class, $formeStepChamps);
            $formStepChampsType->handleRequest($request);
        }
        if ($request->getMethod() == 'POST') {
            $entityManager->persist($forme);
           // $formeStep->setForm($forme);
          //  $formeStepChamps->setFormStep($formeStep);
        //    $entityManager->persist($forme);
          //  $entityManager->persist($formeStep);
           // $entityManager->persist($formeStepChamps);
            $entityManager->flush();
            return $this->redirectToRoute('app_form_edit', ['id'=>$forme->getId()], Response::HTTP_SEE_OTHER);
        }
        $formeStepChamps = $entityManager->getRepository(FormStepChamps::class)->findBy(['formStep'=>$formeStep->getId()]);
        return $this->renderForm('form/new.html.twig', [
            'formStep'=>$formStep,
            'formSteps'=>$forme->getFormSteps(),
            'formStepChamps'=>$formStepChampsRepository->findAll(),
            'formChamps'=>$formStepChampsType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_edit', methods: ['GET', 'POST'])]
    public function edit( FormStepChampsRepository $formStepChampsRepository , Request $request, Form $forme, EntityManagerInterface $entityManager): Response
    {

        $formeStep = new FormStep();
        $formeStepChamps = new FormStepChamps();
        $form = $this->createForm(FormType::class, $forme);
        $formStep = $this->createForm(FormStepType::class, $formeStep);

        $form->handleRequest($request);
        $formStep->handleRequest($request);
        if ($request->getMethod() == 'GET') {
            $formStepChampsType = $this->createForm(FormStepChampsType::class, $formeStepChamps);
            $formStepChampsType->handleRequest($request);
        }
        if ($request->getMethod() == 'POST') {

            $formeStep->setForm($forme);
            $formeStepChamps->setFormStep($formeStep);
            $entityManager->persist($formeStep);
            //$entityManager->persist($formeStepChamps);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_edit', ['id'=>$forme->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('form/edit.html.twig', [
            'formStep'=>$formStep,
            'formSteps'=>$forme->getFormSteps(),
            'formStepChamps'=>$formStepChampsRepository->findAll(),
            'formChamps'=>$formStepChampsType,
            'form' => $form,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_form_delete', methods: ['GET'])]
    public function delete(Request $request, Form $form, EntityManagerInterface $entityManager): Response
    {
      //  die();
        //if ($this->isCsrfTokenValid('delete'.$form->getId(), $request->request->get('_token'))) {
        $formEtats = $entityManager->getRepository(FormEtat::class)->findBy(['form'=>$form->getId()]);
        $formStepChamps = $entityManager->getRepository(FormStep::class)->findBy(['form'=>$form->getId()]);
        foreach ($formEtats as $formEtat) {
            $formEtatVariables = $entityManager->getRepository(FormEtatVariable::class)->findBy(['formEtat' => $formEtat->getId()]);
            foreach ($formEtatVariables as $formEtatVariable) {
                $entityManager->remove($formEtatVariable);
                $entityManager->flush();
            }
            $entityManager->remove($formEtat);
            $entityManager->flush();
        }
        foreach ($formStepChamps as $formStepChamp){
            $entityManager->remove($formStepChamp);
            $entityManager->flush();
        }
            $entityManager->remove($form);
            $entityManager->flush();
      //  }

        return $this->redirectToRoute('app_form_index', [], Response::HTTP_SEE_OTHER);
    }
}
