<?php 

require_once 'Model/BilletModel.php';
require_once 'Model/CommentaireModel.php';
// require_once 'Entite/Vue.php';

class ControleurBillet{

    private $billetModel;
    private $commentaireModel;

    public function __construct()
    {
        $this->billetModel = new BilletModel();   
        $this->commentaireModel = new CommentaireModel(); 
    }

    
    
    /**
     * Affiche les détails sur un billet
     */
    function billet ($id_billet)
    {
        $billet = $this->billetModel->getBillet($id_billet);
        $commentaires = $this->commentaireModel->getCommentaires($id_billet);
        
        $vue = new Vue('Billet'); //require_once 'Vue/vueBillet.php';
        $vue->generer(['billet' => $billet, 'commentaires' => $commentaires]);
      
    }

    public function commenter($auteur, $contenu, $id_billet)
    {
        $this->commentaireModel->addCommentaire($auteur, $contenu, $id_billet);

        $this->billet($id_billet);
    }
}