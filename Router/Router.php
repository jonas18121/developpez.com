<?php 
    
// require_once 'Controleur/ControleurAccueil.php';
// require_once 'Controleur/ControleurBillet.php';
require_once 'Entite/URL.php';
require_once 'Entite/Vue.php';
require_once 'outil/outil.php';


class Router{

    /* private $controleurAccueil;
    private $controleurBillet;

    public function __construct()
    {
        $this->controleurAccueil = new ControleurAccueil();
        $this->controleurBillet = new ControleurBillet();
    } */

    /**
     * Gère une erreur d'exécution (exception)
     *  permet d'afficher la vue d'erreur
     */
    private function gererErreur(Exception $exception)
    {
        $vue = new Vue('Erreur'); //require_once 'vueErreur.php'
        $vue->generer(['msgErreur' => $exception->getMessage()]);
    }

    /**
     * Recherche un paramètre dans un tableau  et retourne sa valeur
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

    /**
     * Route une URL entrante : exécute l'action associée
     */
    public function routerRequete (){

        try{

            // Fusion des paramètres GET et POST de l'URL
            $fusion_param_url = new URL(array_merge($_GET, $_POST));

            $controleur = $this->creerControleur($fusion_param_url);

            $action = $this->creerAction($fusion_param_url);
            //  pre_var_dump('l 58 Router',$controleur, true);

            $controleur->executerAction($action);

        }
        catch(Exception $exception){
            $this->gererErreur($exception);
        }
    }

    /**
     * récupère le paramètre controleur de l'url' reçue
     * et le concatène pour construire le nom du fichier contrôleur
     * et renvoyer une instance de la classe associée
     * 
     * En l'absence de ce paramètre, 
     * elle cherche à instancier la classe ControleurAccueil qui correspond au contrôleur par défaut
     */
    private function creerControleur(URL $fusion_param_url)
    {
        //s'il existe un paramètre $_GET['controleur'] ou $_POST['controleur'] on continu
        if ($fusion_param_url->existeParametre('controleur')) 
        {
            // retourne la valeur du paramètre controleur qui est dans l'url
            $nom_controleur = $fusion_param_url->getParametre('controleur');

            // On met la première lettre en majuscule
            $nom_controleur = ucfirst(strtolower($nom_controleur));
        }
        else {
            $nom_controleur = 'Accueil'; // Contrôleur par défaut
        }

        //exemple : "ControleurAccueil"
        $classe_controleur = 'Controleur' . $nom_controleur; 

        //exemple : "Controleur/ControleurAccueil.php"
        $fichier_controleur = 'Controleur/' . $classe_controleur . '.php'; 

        //pre_var_dump('L 76 Router.php', $fichier_controleur, true);

        if(file_exists($fichier_controleur))
        {
            // require du contrôleur adapté à la requête
            require $fichier_controleur;
            
            // Instanciation du contrôleur adapté à la requête
            $controleur = new $classe_controleur();

            // pre_var_dump($fusion_param_url , null, true);
            $controleur->setUrl($fusion_param_url);

            //pre_var_dump('l 109 Router.php' , $controleur, true);
            return $controleur;
        }
        else{
            throw new Exception("Fichier '$fichier_controleur' introuvable");
        }

    }

    /**
     * récupère le paramètre action de l'url reçue et le renvoie
     * En l'absence de ce paramètre, elle renvoie la valeur « index » qui correspond à l'action par défaut.
     */
    private function creerAction(URL $fusion_param_url)
    {
        if ($fusion_param_url->existeParametre('action')) 
        {
            // exemple : "billet"
            $nom_action = $fusion_param_url->getParametre('action');
            
        }
        else {
            $nom_action = 'index'; // Action par défaut
        }

        return $nom_action;
    }





























    /**
     * Route une URL entrante : exécute l'action associée
     */
    public function routerRequete2 (){

        try{

            // Fusion des paramètres GET et POST de l'URL
            $fusion_param_url = new URL(array_merge($_GET, $_POST));

            if (isset($_GET['action']) && !empty($_GET['action'])) {

                if($_GET['action'] === 'billet'){
                    //var_dump($_POST);die;
                    
                    $id_billet = intval($this->getParametre($_GET, 'id'));

                    if($id_billet != 0){
                        $this->controleurBillet->billet($id_billet);
                    }
                    else {
                        throw new Exception("Identifiant de billet non valide");
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
            $this->gererErreur($e);
        }
    }

    
}