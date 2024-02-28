<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Exo5Controller extends AbstractController
{
# Exercice 4 : fonction
    #[Route('/exo5/{nom}', name: 'app_exo')]
    public function index($nom): Response
    {
        return $this->render('exo5/index.html.twig', [
            'controller_name' => 'ExoController', 
            "nom" => $nom ,
        ]);
    }
# Exercice 5 : Twig et Controller, reprise de l'exo 3

#[Route("/exo5/{nbr1}/{nbr2}/{operateur}")]
public function exo($nbr1, $nbr2, $operateur) {

    if(!is_numeric($nbr1)&&!is_numeric($nbr2)) {
        $message = "Les 2 valeurs ne correspondent pas à des nombres";
    }
    else {
        
        switch ($operateur) {
            case "add":
                $message = "Le resultat de l'addition est égale à " . ($nbr1 + $nbr2);
                break;
            case "sub":
                $message = "Le resultat de la soustraction est égale à " . ($nbr1 - $nbr2);
                break;
            case "div":
                if($nbr2 == 0) {
                    $message = "Division par zéro impossible";
                }
                else {
                    $message = "Le resultat de la division est égale à ". ($nbr1 / $nbr2);
                }
                break;
            case "multi":
                $message = "Le resultat de la multiplication est égale à " . ($nbr1 * $nbr2);
                break;
            default:
                $message = "L'opérateur n'est pas valide";
                break;
        }
    }
    return $this->render('exo5/index.html.twig', [
        'controller_name' => 'ExoController',
        "nbr1" => $nbr1,
        "nbr2" => $nbr2,
        "operateur" => $operateur,
        "message" => $message ,
    ]);
    //return $this->render('twig/index.html.twig');
    //return new Response($message);
}

//Correction exercice 5 :

// #[Route('/exercice5/{nbr1}/{nbr2}/{operateur}', name:'app_exercice_5')]
// public function calculette($nbr1, $nbr2, $operateur) : Response 
// {
//     try {
//         !is_numeric($nbr1) || !is_numeric($nbr2)?throw new \Exception('Les variables $nbr1 et $nbr2 ne sont pas des nombres'):null;
//         switch ($operateur) {
//             case 'add':
//                 $resultat = $nbr1 + $nbr2;
//                 break;
//             case 'sub':
//                 $resultat = $nbr1 - $nbr2;
//                 break;
//             case 'div':
//                 $nbr2 == 0?throw new \Exception("la division par zéro est impossible"):null;
//                 $resultat = $nbr1 / $nbr2;
//                 break;
//             case 'multi':
//                 $resultat = $nbr1 * $nbr2;
//                 break;
//             default:
//                 $resultat = "L'opérateur n'est pas valide";
//                 break;
//         }
//     } 
//     catch (\Throwable $th) {
//         $resultat = $th->getMessage();
//     }
    
//     return $this->render('exercice/calculatrice.html.twig',[
//         'nbr1' => $nbr1,
//         'nbr2' => $nbr2,
//         'operateur' => $operateur,
//         'resultat' => $resultat
//     ]);
// }

}
