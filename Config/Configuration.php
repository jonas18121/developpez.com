<?php

/**
 * Gérer la configuration du site, afin de pouvoir définir les paramètres de connexion à la BDD 
 * sans modifier le code source.
 * 
 * Pour que la classe Model (Model/Model.php) soit totalement générique et donc intégrable à un framework
 * 
 * Grâce à cette classe Configuration, on peut externaliser la configuration d'un site en dehors de son code source
 */
class Configuration 
{

    private static $parametres;

    /**
     * Rechercher la valeur d'un paramètre à partir de son nom.
     * Si le paramètre en question est trouvé dans le tableau associatif que retourne getParametres(), sa valeur est renvoyée.
     * Sinon, une valeur par défaut est renvoyée
     * 
     * @return - Renvoie la valeur d'un paramètre de configuration
     */
    public static function get ($nom, $valeur_par_defaut = null)
    {
        if (isset(self::getParametres()[$nom])) 
        {
            $valeur = self::getParametres()[$nom];
        }
        else {
            $valeur = $valeur_par_defaut;
        }
        // pre_var_dump('L 27 Configuration.php', self::getParametres()[$nom]);

        return $valeur;
    }

    /**
     * vérifie si 'Config/ini/prod.ini' existe, sinon si 'Config/ini/dev.ini' existe, 
     * si ces 2 fichiers n'existe pas, on lance une erreur
     * 
     * Si 'Config/ini/prod.ini' ou 'Config/ini/dev.ini' existe,
     * on analyse l'un de ces 2 fichiers de configuration de type .ini, grâce à parse_ini_file().
     * 
     * parse_ini_file() charge le fichier et retourne les configurations qui s'y trouve sous forme d'un tableau associatif.
     * 
     * @return array - Renvoie le tableau associatif des paramètres en le chargeant au besoin
    */
    private static function getParametres()
    {
        if (self::$parametres === null) 
        {
            $chemin_fichier = 'Config/ini/prod.ini';

            if (!file_exists($chemin_fichier)) 
            {
                $chemin_fichier = 'Config/ini/dev.ini';
            }

            if (!file_exists($chemin_fichier)) 
            {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else {
                self::$parametres = parse_ini_file($chemin_fichier);
            }
            // pre_var_dump('L 65 Configuration.php', self::$parametres);
        }
        return self::$parametres;
    }
}