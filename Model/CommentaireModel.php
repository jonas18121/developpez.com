<?php

require_once 'Model.php';

class CommentaireModel extends Model {

    public function getCommentaires($id_billet)
    {
        $sql = 'SELECT * FROM t_commentaire WHERE bil_id = ?';
        $commentaires = $this->executerRequete($sql, [$id_billet]);
        return $commentaires;
    }

    public function addCommentaire($auteur, $contenu, $id_billet)
    {
        $sql = 'INSERT INTO t_commentaire (com_auteur, com_contenu, bil_id) VALUES (?, ?, ?)';
        $this->executerRequete($sql, [$auteur, $contenu, $id_billet]);
    }

}