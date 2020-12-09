<?php

require_once 'Config/Configuration.php';

/**
 * Classe abstraite Model.
 * Centralise les services d'accès à une base de données.
 * Utilise l'API PDO de PHP
 * 
 * @version 1.0
 * @author Jonathan
 */
abstract class Model{

    private static $bdd;

    /**
     *  Effectue la connexion à la BDD
     *  Instancie et renvoie l'objet PDO associé
     * 
     * @return PDO Objet PDO de connexion à la BDD
     */
    private function getBdd()
    {
        if (self::$bdd === null) 
        {    
            // Récupération des paramètres de configuration BD
            $dsn        = Configuration::get('dsn');
            $login      = Configuration::get('login');
            $password   = Configuration::get('password');

            // pre_var_dump('L 31 Model.php', $dsn, true);
            
            self::$bdd = new PDO($dsn, $login , $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }

        return self::$bdd;
    }

    /**
     * Exécute une requête SQL éventuellement paramétrée
     * 
     * @param string - $sql Requête SQL
     * @param array - $params Paramètres de la requête
     * 
     * @return PDOStatement Résultats de la requête
     */
    protected function executerRequete($sql, $params = null)
    {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql); // exécution directe
        } else {
            
            $resultat = $this->getBdd()->prepare($sql); // requête préparée
            $resultat->execute($params); 
        }

        return $resultat;
    }
}



