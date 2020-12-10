<?php

require_once 'URL.php';
require_once 'Vue.php';

/**
 * Cette classe a pour attributs l'action à réaliser et l'url
 * 
 *  Sa méthode executerAction() met en œuvre le concept de réflexion : 
 *      elle utilise les fonctions PHP method_exists et get_class afin de faire appel 
 *      la méthode ayant pour nom l'action à réaliser.
 * 
 * La méthode index() est abstraite. Cela signifie que tous nos contrôleurs, qui hériteront de Controleur, 
 * devront obligatoirement définir une méthode index() qui correspond à l'action par défaut 
 * (quand le paramètre action n'est pas défini dans la requête).
 * 
 * Enfin, la méthode genererVue() permet d'automatiser le lien entre contrôleur et vue : 
 *      les paramètres de création de la vue sont déduits du nom du contrôleur et de l'action à réaliser
 */
abstract class Controleur
{
    /** Action à réaliser */
    private $action;

    /** Url entrante */
    protected $url;

    /**
     * Définit la url entrante
     */
    public function setUrl(URL $url)
    {
        $this->url = $url;
    }

    /**
     * Exécute l'action à réaliser
     * l'action qui est la methode dans le controleur précis
     */
    public function executerAction($action)
    {
        if (method_exists($this, $action)) 
        {
            $this->action = $action;

            $this->{$this->action}(); // execute la methode billet() par exemple
            
        }
        else {
            $classe_controleur = get_class($this);
            throw new Exception("Action '{$action}' non définie dans la classe {$classe_controleur}");
        }
    }

    
    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par défaut
     */
    public abstract function index();


    /**
     * Génère la vue associée au contrôleur courant
     * 
     * permet d'automatiser le lien entre contrôleur et vue 
     * les paramètres de création de la vue sont déduits du nom du contrôleur et de l'action à réaliser
     */
    protected function genereVue($donnees_vue = [])
    {
        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
        // exemple : "ControleurBillet"
        $class_controleur = get_class($this);
        
        // exemple : "Billet"
        $nom_controleur = str_replace('Controleur', '', $class_controleur);
        // pre_var_dump('L 74 Controleur', $this->action, true);

        // Instanciation et génération de la vue
        $vue = new Vue($this->action, $nom_controleur);
        $vue->generer($donnees_vue);
    }
}