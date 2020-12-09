<?php $titre = 'Mon Blog'; ?>

<h1>Liste de billets</h1>
<?php foreach($billets as $billet) : ?>

    <article>
        <header>
            <h2 class="titreBillet">
                <a href="index.php?action=billet&id=<?= $billet['id'] ?>"> <?= $billet['bil_titre'] ?> </a>
            </h2>
            <time><?= $billet['bil_date'] ?></time>
        </header>
        <p><?= $billet['bil_contenu'] ?></p>
    </article>

<?php endforeach; ?>
    