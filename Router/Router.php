<?php 
    
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurBillet.php';
require_once 'Entite/Vue.php';
require_once 'outil/outil.php';


class Router{

    private $controleurAccueil;
    private $controleurBillet;

    public function __construct()
    {
        $this->controleurAccueil = new ControleurAccueil();
        $this->controleurBillet = new ControleurBillet();
    }

    /**
     * Recherche un paramètre dans un tableau 
     * exemple dans un $_GET ou dans un $_POST en fonction du besoin.
     */
    public function getParametre($_verbe_http, $nom)
    {
        if(isset($_verbe_http[$nom])){
            return $_verbe_http[$nom];
        }
        else {
            throw new Exception("Paramètre '$nom' absent");
        }
    }


    public function routerRequete (){

        try{
            if (isset($_GET['action']) && !empty($_GET['action'])) {

                if($_GET['action'] === 'billet'){
                    //var_dump($_POST);die;
                    if (isset($_GET['id'])) {
    
                        $id_billet = intval($this->getParametre($_GET, 'id'));

                        if($id_billet != 0){
                            $this->controleurBillet->billet($id_billet);
                        }
                        else {
                            throw new Exception("Identifiant de billet non valide");
                        }
                    }
                    else{
                        throw new Exception("Identifiant de billet non défini");
                    }
                }
                elseif ($_GET['action'] === 'commenter') 
                {
                    ///var_dump($_POST);die;
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $id_billet = $this->getParametre($_POST, 'id');
                    $this->controleurBillet->commenter($auteur, $contenu, $id_billet);
                }
                else{
                    throw new Exception("Action non valide");
                }

            }
            else {
                $this->controleurAccueil->accueil();  // action par défaut
            }
        }
        catch(Exception $e){
            $this->erreur($e->getMessage());
        }
    }

    private function erreur($msgErreur)
    {
        $vue = new Vue('Erreur'); //require_once 'vueErreur.php'
        $vue->generer(['msgErreur' => $msgErreur]);
    }
}