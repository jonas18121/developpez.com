<?php $titre = "Mon Blog - " . $billet['bil_titre']; ?>

<?php ob_start() ?>

    <article>
        <header>
            <h1 class="titreBillet"><?= $billet['bil_titre'] ?></h1>
            <time><?= $billet['bil_date'] ?></time>
        </header>
        <p><?= $billet['bil_contenu'] ?></p>
    </article>

    <header>
        <h2 class="titreCommentaire">Commentaire pour <?= $billet['bil_titre'] ?> </h2>
    </header>

    <?php foreach ($commentaires as $commentaire) : ?>
        <p><?= $commentaire['com_auteur'] ?></p>
        <p><?= $commentaire['com_contenu'] ?></p>
    <?php endforeach ?>
        

<?php $contenu =  ob_get_clean(); ?>
<?php require 'Vue/gabarit.php'; ?>