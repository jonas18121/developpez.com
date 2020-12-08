<?php 
    
require_once 'Controleur/Controleur.php';

try{
    if (isset($_GET['action'])) {
        if(isset($_GET['action']) == 'billet'){
            if (isset($_GET['id'])) {

                $id_billet = intval($_GET['id']);
                if($id_billet != 0){
                    billet($id_billet);
                }
                else {
                    throw new Exception("Identifiant de billet non valide");
                }
            }
            else{
                throw new Exception("Identifiant de billet non défini");
            }
        }
        else{
            throw new Exception("Action non valide");
        }
    }
    else {
      accueil();  // action par défaut
    }
}
catch(Exception $e){

    $msgErreur = $e->getMessage();
    require_once 'vueErreur.php';
}