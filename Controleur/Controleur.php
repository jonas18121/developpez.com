<?php 

require 'Modele/Modele.php';

/**
 * afficher la liste de tous les billets, triés par date décroissant
 */
function accueil()
{
    $billets = getBillets();
    require_once 'Vue/vueAccueil.php';
}

/**
 * Affiche les détails sur un billet
 */
function billet ($id_billet)
{
    $billet = getBillet($id_billet);
    $commentaires = getCommentaires($id_billet);
    require_once 'Vue/vueBillet.php';
}

function erreur ($msErreur){
    require_once 'Vue/vueErreur.php';
}