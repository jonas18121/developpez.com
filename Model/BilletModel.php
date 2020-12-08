<?php 

require_once 'Model.php';

class BilletModel extends Model {


    /**
     * Renvoie la liste de tous les billets, triés par date décroissant
     */
    public function getBillets()
    {
        $sql = 'SELECT * FROM t_billet ORDER By bil_date DESC';
        $billets = $this->executerRequete($sql);
        return $billets;
    }
    
    /**
     * Renvoie un billets précis
     */
    public function getBillet($id_billet)
    {
        $sql = 'SELECT * FROM t_billet WHERE id = ?';
        
        $billet = $this->executerRequete($sql, [$id_billet]);
    
        if ($billet->rowCount() == 1) {
            return $billet->fetch();
        }
        else {
            throw new Exception("Aucun billet ne correspond à l'identifiant '{$id_billet}'");
        }
    }

    
}