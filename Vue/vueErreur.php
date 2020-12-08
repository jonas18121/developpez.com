<?php $titre = 'Erreur'; ?>

<?php ob_start(); ?>
    <p> Une erreur est survenue : <?= $msgErreur ?>
<?php $contenu = ob_get_clean(); ?>
<?php require_once 'Vue/gabarit.php' ?>