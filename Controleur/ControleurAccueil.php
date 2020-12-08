<?php 

require_once 'Model/BilletModel.php';
require_once 'Model/CommentaireModel.php';
require_once 'Entite/Vue.php';

class ControleurAccueil{

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
        $vue = new Vue('Accueil'); //require_once 'Vue/vueAccueil.php';
        $vue->generer(['billets' => $billets]);
    }
}