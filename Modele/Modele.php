<?php

/**
 *  Effectue la connexion à la BDD
 *  Instancie et renvoie l'objet PDO associé
 */
function getBdd(){
    $bdd = new PDO('mysql:host=localhost;dbname=developpezCom;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    return $bdd;
}

/**
 * Renvoie la liste de tous les billets, triés par date décroissant
 */
function getBillets()
{
    $bdd = getBdd();
    $billets = $bdd->query('SELECT * FROM t_billet ORDER By bil_date DESC');
    return $billets;
}

/**
 * Renvoie un billets précis
 */
function getBillet($id_billet)
{
    $bdd = getBdd();
    $billet = $bdd->prepare('SELECT * FROM t_billet WHERE id = ?');
    $billet->execute([$id_billet]);

    if ($billet->rowCount() == 1) {
        return $billet->fetch();
    }
    else {
        throw new Exception("Aucun billet ne correspond à l'identifiant '{$id_billet}'");
    }
}


function getCommentaires($id_billet)
{
    $bdd = getBdd();
    $commentaires = $bdd->prepare('SELECT * FROM t_commentaire WHERE bil_id = ?');
    $commentaires->execute([$id_billet]);
    return $commentaires;
}



