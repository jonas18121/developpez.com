<?php $titre = 'Mon Blog'; ?>

<?php ob_start(); ?>
    <?php foreach($billets as $billet) : ?>

        <article>
            <header>
                <h1 class="titreBillet">
                    <a href="index.php?action=billet&id=<?= $billet['id'] ?>"> <?= $billet['bil_titre'] ?> </a>
                </h1>
                <time><?= $billet['bil_date'] ?></time>
            </header>
            <p><?= $billet['bil_contenu'] ?></p>
        </article>

    <?php endforeach; ?>
<?php $contenu = ob_get_clean(); ?>
<?php require_once 'Vue/gabarit.php' ?>
        