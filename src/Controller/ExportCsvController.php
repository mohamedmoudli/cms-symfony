<?php

namespace App\Controller;

use App\Entity\Form;
use App\Repository\FormRepository;
use App\Repository\FormStepChampsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ExportCsvController extends AbstractController
{

    #[Route('/export-csv', name: '/export-csv', methods: ['GET'])]
    public function exportCsvAction(FormRepository $formRepository)
    {
        // Your data to export (replace this with your actual data)

          //die('ddddddd');
        $form = $formRepository->findOneBy(['id'=>7]);
        $formTitre =  $form->getTitre();
        $formId =  $form->getId();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($form, 'json', ["attributes" => ['id' ,'label' , 'titre' , 'descriptionDebut' , 'descriptionFin' ,'formSteps'=>['id' , 'titre' ,  'description' , 'formStepChamps'=>['id' , 'ordre' , 'obligatoire' , 'formChamps'=>['label']] ]]] );
        $response = json_encode($response);
       // $cles =   $this->extraireClesRecursif($response);
       // $values =   $this->extraireValueRecursif($response);
        $response = new StreamedResponse(function () use ($formId ,$formTitre,$response) {
            $handle = fopen('php://output', 'w+');

            // Add a header row to the CSV
            fputcsv($handle, ['id' , 'form' , 'json'] ,'|');
            fputcsv($handle, [$formId ,$formTitre , $response] , '|');

            /*// Add data rows to the CSV
            foreach ($values as $row) {
               // var_dump($row);
                //fputcsv($handle, $row);
            }*/

            fclose($handle);
        });



        // Set headers for the response
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

        return $response;
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