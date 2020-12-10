<?php 

require_once 'Model/BilletModel.php';
require_once 'Model/CommentaireModel.php';
require_once 'Entite/Vue.php';
require_once 'Entite/Controleur.php';

class ControleurAccueil extends Controleur 
{

    private $billetModel;

    public function __construct()
    {
        $this->billetModel = new BilletModel();
    }

    /**
     * afficher la liste de tous les billets, triés par date décroissant
     */
    function accueil()
    {
        $billets = $this->billetModel->getBillets();
        $vue = new Vue('accueil', 'Accueil'); //require_once 'Vue/vueAccueil.php';
        $vue->generer(['billets' => $billets]);
    }

    /**
     * function imposé par la class Controleur
     * action par défaut (quand le paramètre action n'est pas défini dans la requête).
     */
    public function index()
    {
        $this->accueil();
        /* $billets = $this->billetModel->getBillets();
        $vue = new Vue('accueil', 'Accueil'); //require_once 'Vue/vueAccueil.php';
        $vue->generer(['billets' => $billets]); */
    }
}