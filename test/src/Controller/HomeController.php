<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    #[Route('/home', name: 'app_home')]
    public function homeMessage() : Response {
        return new Response("Hello World !");
    }
# Exercice 1
    # [Route('/afficher/message', name: 'app_afficher_message')]
    public function afficherMessage() : Response {
        return new Response("Voici le message");
    }

    #[Route('/afficher/message/bis', name: 'app_afficher_message_bis')]
    public function afficherMessageBis() : Response {
        return new Response("Comment vas-tu Yau-de-Pôele ?");
    }

    #[Route('/bonjour/{utilisateur}', name:'app_bonjour')]

    public function bonjourUtilisateur($utilisateur) : Response {
        return new Response ($utilisateur);        
    }

    # [Route('/bonjour/{utilisateur}', name:'app_bonjour')]

    public function bonjourBis($user) : Response {
        return new Response ($user);        
    }
#Exercice 2
    public function ajouterNombre($nbr1, $nbr2) : Response {
        //return new Response ("La somme de" $nbr1 "et de" $nbr2 "est égale à :" ($nbr1 + $nbr2));
        if (ctype_digit ($nbr1) && ctype_digit($nbr2)) {
            $var = ($nbr1+$nbr2) ;
            return new Response ("Le résultat est égal à " .$var);
        } else if ($nbr1 != (int)$nbr1 && $nbr2 == (int)$nbr2) {
            return new Response ("$nbr1 n'est pas un numéro");
        } else if ($nbr2 != (int)$nbr2 && $nbr1 == (int)$nbr1) {
            return new Response ("$nbr2 n'est pas un numéro");
        } else {
            return new Response ("$nbr1 et $nbr2 ne sont pas des numéros");
        }   
    }

# Exercice 2 correction :
        //version avec le test (si nbr1 et nbr2 sont bien des nombres)
        #[Route('/ajouter/{nbr1}/{nbr2}')]
        public function ajouterUnNombre(mixed $nbr1, mixed $nbr2) : Response 
        {
      
            if(is_numeric($nbr1) AND is_numeric($nbr2)) {
                $reponse = "La somme des 2 nombres est égal à : " . ($nbr1 / $nbr2);
            }
            else {
                $reponse = "nbr1 ou nbr2 ne sont pas des nombres";
            }
            return new Response($reponse);
        }

# Exercice 3 :
#Ne marche pas : il me faut déplacer "l'épaisseur" de la division par zéro pour la mettre dans le else-if de la div.
    #[Route('/calculate/{nbr1}/{nbr2}/{operateur}', name:'app_calculate')]
    public function calculate($nbr1, $nbr2, $operateur) : Response {
        if ($operateur == 'div' || $operateur == "add" || $operateur == "sub" || $operateur == "multi") {
            if ($nbr2 != 0 && $operateur === "div") {
                if (ctype_digit ($nbr1) && ctype_digit($nbr2)) {
                    if ($operateur == "add") {
                        $valr = $nbr1+$nbr2;
                        $text = "La somme";
                    } else if ($operateur == "sub") {
                        $valr = $nbr1-$nbr2;
                        $text = "La soustraction";
                    } else if ($operateur == "multi") {
                        $valr = $nbr1*$nbr2;
                        $text = "La multiplication";
                    } else if ($operateur == "div") {
                        $valr = $nbr1/$nbr2;
                        $text = "La division";
                    }
                    return new Response ($text ." de $nbr1 et de $nbr2 est égale à " .$valr);
                } else if ($nbr1 != (int)$nbr1 && $nbr2 == (int)$nbr2) {
                    return new Response ("$nbr1 n'est pas un numéro");
                } else if ($nbr2 != (int)$nbr2 && $nbr1 == (int)$nbr1) {
                    return new Response ("$nbr2 n'est pas un numéro");
                } else {
                    return new Response ("$nbr1 et $nbr2 ne sont pas des numéros");
                }
            } else {
                return new Response ("La division par zéro est impossible !");
            }
        } else {
            return new Response ("L'opérateur n'est pas valide");
        }
        
    }

# Exercice 3 correction (plus simple) version simple (tu me diras moi aussi ça allait) :

#[Route('/calculer/{nbr1}/{nbr2}/{operateur}', name:'app_calculer')]
public function calculer($nbr1, $nbr2, $operateur) : Response 
{

    if(!is_numeric($nbr1)&&!is_numeric($nbr2)) {
        $message = "Les 2 valeurs ne correspondent pas à des nombres";
    }
    else {
        
        switch ($operateur) {
            case "add":
                $message = "Le resultat de l'addition est égal : " . ($nbr1 + $nbr2);
                break;
            case "sub":
                $message = "Le resultat de la soustraction est égal : " . ($nbr1 - $nbr2);
                break;
            case "div":
                if($nbr2 == 0) {
                    $message = "Division par zéro impossible";
                }
                else {
                    $message = "Le resultat de la division est égal : ". ($nbr1 / $nbr2);
                }
                break;
            case "multi":
                $message = "Le resultat de la multiplication est égal : " . ($nbr1 * $nbr2);
                break;
            default:
                $message = "L'opérateur n'est pas valide";
                break;
        }
    }
    return new Response($message);
}

#Exercice 3 : correction (avec le bonus qui donne tout plein de fonctionnalités)

#[Route('/calculerex/{nbr1}/{nbr2}/{operateur}', name:'app_calculer_exception')]
    public function calculateException($nbr1, $nbr2, $operateur) : Response 
    {
        //try (si le code plante on passe dans le catch et on récupére notre exception)
        try {
            //opérateur ternaire (si nbr1 ou nbr2) n'est pas un nombre on crée une nouvelle exception
            !is_numeric($nbr1) || !is_numeric($nbr2)?throw new \Exception("nbr1 ou nbr2 ne sont pas des nombres"):null;
            //switch case de l'opérateur
            switch ($operateur) {
                case "add":
                    $message = "Le résultat de l'addition est égal à : " . ($nbr1 + $nbr2);
                    break;
                case "sub":
                    $message = "Le résultat de la soustraction est égal à : " . ($nbr1 - $nbr2);
                    break;
                case "multi":
                    $message = "Le résultat de la multiplication est égal à : " . ($nbr1 * $nbr2);
                    break;
                case "div":
                    //opérateur ternaire si nbr2 == 0 on crée une nouvelle exception
                    $nbr2 == 0?throw new \Exception("la division par zéro est impossible"):null;
                    $message = "Le résultat de la division est égal à : " . ($nbr1 / $nbr2);
                    break;
                //si l'opérateur n'est pas (add ou sub ou multi ou div)
                default:
                    $message = "L'opérateur n'est pas valide";
                    break;
            }
            
        }
//récupérer l'exception si le try crache
    catch (\Throwable $th) {
        $message = "Erreur : " . $th->getMessage();
    }
//retourner la réponse
    return new Response($message);
}

#[Route('/twig', name:'app_exemple')]
public function exemple(){
    return $this->render('twig/index.html.twig');
}

}

