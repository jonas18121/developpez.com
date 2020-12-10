<?php 


/**
 * Le constructeur de Vue prend en paramètre une action, qui détermine le fichier vue utilisé. 
 * 
 * Sa méthode generer() génère d'abord la partie spécifique de la vue afin de définir 
 * son titre (attribut $titre) et son contenu (variable locale $contenu). 
 * 
 * Ensuite, le gabarit est généré en y incluant les éléments spécifiques de la vue. 
 * 
 * Sa méthode interne genererFichier() encapsule l'utilisation de require 
 * et permet en outre de vérifier l'existence du fichier vue à afficher. 
 * 
 * Elle utilise la fonction extract pour que la vue puisse accéder aux variables PHP requises,
 *  rassemblées dans le tableau associatif $donnees.
 */

class Vue {

    /** 
     * Nom du fichier associé à la vue
     * 
     * exemple : "Vue/Accueil/accueil.php"
     *   
     */
    private $fichier;

    /**
     * est définit depuis la vue spécifique 
     * exemple : le titre est placé dans "Vue/Accueil/accueil.php"
     * dans cette forme $this->titre = Accueil
     */
    private $titre;

    /**
     * chaque vue doit résider dans le sous-répertoire Vue/ ;
     * 
     * dans ce répertoire Vue/ , chaque vue est stockée dans un sous-répertoire portant le nom du contrôleur associé à la vue ;
     * 
     * chaque fichier vue porte directement le nom de l'action aboutissant à l'affichage de cette vue.
     */
    public function __construct($action, $controleur = '')
    {
        // Détermination du nom du fichier vue à partir de l'action et du constructeur
        $fichier = 'Vue/';
        if ($controleur != '') 
        {
            $fichier = $fichier . $controleur . '/'; // exemple "Vue/Accueil/"
        }
        $this->fichier = $fichier . $action . '.php'; 
        // exemple : "Vue/accueil.php" si le controleur est vide
        // exemple : "Vue/Accueil/accueil.php" si le controleur n'est pas vide

        //pre_var_dump( 'L 48 Vue.php',$this->fichier, true); 

    }

    /**
     * Génère et affiche la vue
     */
    public function generer($donnees)
    {
        //var_dump($donnees);die; = array(1) { ["billets"]=> object(PDOStatement)#4 (1) { ["queryString"]=> string(45) "SELECT * FROM t_billet ORDER By bil_date DESC" } }
        // pour la function accueil

        // Génération de la partie spécifique de la vue , exemple ce qui est dans le ob_start()
        $contenu = $this->genererFichier($this->fichier, $donnees);

        // On définit une variable locale accessible par la vue pour la racine Web
        // Il s'agit du chemin vers le site sur le serveur Web
        // Nécessaire pour les URI de type controleur/action/id
        $racine_web = Configuration::get('racine_web', '/');

        
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('Vue/gabarit.php', ['titre' => $this->titre, 'contenu' => $contenu, 'racine_web' => $racine_web]);
        //pre_var_dump( 'L 75 Vue.php',$vue, true);
        
        echo $vue; // Renvoi de la vue au navigateur
    }


    /**
     * Génère un fichier vue et renvoie le résultat 
     */
    public function genererFichier($fichier, $donnees)
    {
        if (file_exists($fichier)) {
            
            // Rend les éléments du tableau $donnees accessibles dans la vue 
            // exemple : ['les_billets' => $billets] devient $les_billets = la vue de la liste des billets 
            // autre exemple : ["billets"]=> object(PDOStatement)#4 devient $billets = la liste des billets depuis la bdd
            extract($donnees);

            // Démarrage de la temporisation de sortie
            ob_start();

            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fichier;

            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else{
            throw new Exception("Fichier '{$fichier}' introuvable");
        }
    }
}