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
     * exemple : "Vue/vueAccueil.php"
     *   
     */
    private $fichier;

    /**
     * est définit depuis la vue spécifique 
     * exemple : le titre est placé dans "Vue/vueAccueil.php" 
     * dans cette forme $this->titre = Accueil
     */
    private $titre;

    
    public function __construct($action)
    {
        $this->fichier = 'Vue/vue' . $action . '.php'; 
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

        
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('Vue/gabarit.php', ['titre' => $this->titre, 'contenu' => $contenu]);
        
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