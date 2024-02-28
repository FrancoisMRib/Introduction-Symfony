<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Exo6Controller extends AbstractController
{
    #[Route('/exo6/{nom}', name: 'app_exo6')]
    public function afficherNom($nom): Response
    {
        return $this->render('exo6/index.html.twig', [
            'name' => $nom,
            // 'controller_name' => 'Exo6Controller',
        ]);
    }

    //Exercice 6 : Twig et condition
    #[Route('/exo6/{nbr1}/{nbr2}/{operateur}')]
    public function new($nbr1, $nbr2, $operateur) : Response {
        return $this->render('exo6/correction.html.twig',[
            'nbr1' => $nbr1,
            'nbr2' => $nbr2,
            'operateur' => $operateur,
        ]);
}
}
