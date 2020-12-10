<?php 

require_once 'Model/BilletModel.php';
require_once 'Model/CommentaireModel.php';
require_once 'Entite/Controleur.php';
// require_once 'Entite/Vue.php';

class ControleurBillet extends Controleur
{

    private $billetModel;
    private $commentaireModel;

    public function __construct()
    {
        $this->billetModel = new BilletModel();   
        $this->commentaireModel = new CommentaireModel(); 
    }

    /**
     * function imposé par la class Controleur
     * action par défaut (quand le paramètre action n'est pas défini dans la requête).
     */
    public function index()
    {
        $this->billet();
    }

    
    
    /**
     * Affiche les détails sur un billet
     * 
     * billet ($id_billet)
     */
    function billet ()
    {
        // vérifie si le paramètre id a bien été envoyé en $_GET ou en $_POST et renvoie sa valeur 
        // ici c'est envoyer en $_GET
        $id_billet = $this->url->getParametre("id");
        // pre_var_dump('L 39 ControleurBillet.php',$id_billet, true );

        $billet = $this->billetModel->getBillet($id_billet);
        $commentaires = $this->commentaireModel->getCommentaires($id_billet);
        
        $this->genereVue(['billet' => $billet, 'commentaires' => $commentaires]);
        // $vue = new Vue('billet', 'Billet'); //require_once 'Vue/vueBillet.php';
        // $vue->generer(['billet' => $billet, 'commentaires' => $commentaires]);
      
    }

    /**
     * commenter($auteur, $contenu, $id_billet)
     */
    public function commenter()
    {
        // vérifie si les paramètre id, auteur et contenu ont bien été envoyé en $_GET ou en $_POST et renvoie leurs valeurs
        // ici c'est envoyer en $_POST
        $id_billet = $this->url->getParametre("id");
        $auteur = $this->url->getParametre("auteur");
        $contenu = $this->url->getParametre("contenu");

        $this->commentaireModel->addCommentaire($auteur, $contenu, $id_billet);

        // $this->billet();

        // Exécution de l'action par défaut pour réafficher la liste des billets
        $this->executerAction("billet");
    }
}