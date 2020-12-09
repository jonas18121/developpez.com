<?php


/**
 * le rôle est de modéliser une URL
 * 
 * stocker les paramètres de l'URL' reçue
 */
class URL
{
    /**
     * index.php?controleur=billet&action=mes_billets&id=1
     * 
     * paramètres de l'url
     * exemple : GET et POST
     */
    private $parametres;

    public function __construct($parametres)
    {
        $this->parametres = $parametres;
    } 

    /**
     * @param string $nom 
     * 
     * @return boolean - Renvoie vrai si le paramètre existe dans l'URL
     */
    public function existeParametre($nom)
    {
        return (isset($this->parametres[$nom]) && $this->parametres[$nom] != '');
    }

    /**
     * index.php?controleur=billet&action=mes_billets&id=1
     * 
     * @param string $nom - Nom du controleur depuis l'url, exemple : billet
     * 
     * @return - Renvoie la valeur du paramètre demandé exemple : billet
     * ou Lève une exception si le paramètre est introuvable
     */
    public function getParametre($nom)
    {
        //pre_var_dump('L 42 URL.php',$this->parametres[$nom], true );
        if ($this->existeParametre($nom)) {

            return $this->parametres[$nom]; // exemple : "billet"
        }
        else {
            throw new Exception("Paramètre '{$nom}' absent de la requête");
        }
    }

}