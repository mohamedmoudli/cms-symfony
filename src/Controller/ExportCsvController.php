<?php

namespace App\Controller;

use App\Entity\Form;
use App\Repository\FormRepository;
use App\Repository\FormStepChampsRepository;
use App\Repository\MonetiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ExportCsvController extends AbstractController
{

    #[Route('/export-csv/{idForm}/{idMonetique}', name: 'export-csv', methods: ['GET'])]
    public function exportCsvAction(FormRepository $formRepository ,MonetiqueRepository $monetiqueRepository , $idForm , $idMonetique)
    {

        $form = $formRepository->findOneBy(['id'=>$idForm]);
        $monetique = $monetiqueRepository->findOneBy(['id'=>$idMonetique]);
        $formTitre =  $form->getTitre();
        $formId =  $form->getId();
        $monetiqueId =  $monetique->getId();
        $monetiqueTitre =  $monetique->getLabel();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response['form'] = $serializer->normalize($form, 'json', ["attributes" => ['id' ,'label' ,'projet'=>['label'] , 'titre' , 'descriptionDebut' , 'descriptionFin' ,'formSteps'=>['id' , 'titre' ,  'description' , 'formStepChamps'=>['id' , 'ordre' , 'obligatoire' , 'formChamps'=>['label']] ]]] );
        $response['monetique'] = $serializer->normalize($monetique, 'json', ["attributes" => ['id' ,'label' , 'code' , 'monetiqueVariables' => ['label'] , 'monetiqueDroits'=>['id' , 'label' ,'projet'=>['label'] ,  'monetiqueDroitVariables'=>['id' , 'valeur'] ]]] );
        $response = json_encode($response);
        $response = new StreamedResponse(function () use ($formId ,$formTitre,$monetiqueId ,$monetiqueTitre , $response) {
            $handle = fopen('php://output', 'w+');

            // Add a header row to the CSV
            fputcsv($handle, ['idForm' , 'formTitre' , 'monetiqueId' , 'monetiqueTitre' , 'json'] ,'|');
            fputcsv($handle, [$formId ,$formTitre ,$monetiqueId , $monetiqueTitre , $response] , '|');

            fclose($handle);
        });



        // Set headers for the response
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
        return $response;
       // $filePath = $this->getParameter('kernel.project_dir') . '/public/csv/output1.csv';
       // $filesystem = new Filesystem();

        // Write the CSV data to a file
     //   $filesystem->dumpFile($filePath, $response);

       // return new Response('CSV file saved successfully at: ' . $filePath);
    }
    function extraireClesRecursif($tableau)
    {
        $cles = [];

        foreach ($tableau as $cle => $valeur) {
            // Si la valeur est un tableau, appliquer la fonction récursivement
            if (is_array($valeur)) {
                $cles = array_merge($cles, $this->extraireClesRecursif($valeur));
            }elseif (!is_int($cle)){
                $cles[] = $cle;
            }
        }

        return array_values($cles);
    }
    function extraireValueRecursif($tableau)
    {

        $valeurs = [];

        foreach ($tableau as $cle => $valeur) {

            // Si la valeur est un tableau, appliquer la fonction récursivement
            if (is_array($valeur)) {
                $valeurs = array_merge($valeurs, $this->extraireValueRecursif($valeur));
            }else{
                $valeurs[] = $valeur;
            }
        }
        $valeurs =  array_values($valeurs);
        return $valeurs;
    }
}