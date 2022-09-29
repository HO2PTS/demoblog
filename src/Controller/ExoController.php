<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoController extends AbstractController
{
    #[Route('/exo', name: 'app_exo')]
    public function index(): Response
    {
        return $this->render('exo/index.html.twig', [
            'controller_name' => 'ExoController',
        ]);
    }
    #[Route('/voitures', name: 'voitures')]
    public function voiture()
    {
     
     $voiture = 'R5';
     $description = "Une voiture rapid mais ça sert à rien parce que faut respecter les limitations sinon ça coute cher";
     $prix = 2000;

     return $this->render('exo/voiture.html.twig', [
        'modele' => $voiture,
        'description' => $description,
        'prix' => $prix

     ]) ;
    }

}
