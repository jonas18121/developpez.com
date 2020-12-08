<?php $this->titre = "Mon Blog - " . $billet['bil_titre']; ?>

<h1>un Billet</h1>
<article>
    <header>
        <h2 class="titreBillet"><?= $billet['bil_titre'] ?></h2>
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

<form action="index.php?action=commenter&id=<?= $billet['id'] ?>" method="post">
    <div>
        <input type="text" name='auteur' placeholder='Votre pseudo' required>
    </div>

    <div>
        <textarea name="contenu" id="txtCommentaire" cols="24" rows="4" placeholder='Votre commentaire' required></textarea>
    </div>

    <div>
        <input type="hidden" name='id' value='<?= $billet['id'] ?>'>
    </div>

    <div>
        <input type="submit" value="Commenter">
    </div>
</form>
        
