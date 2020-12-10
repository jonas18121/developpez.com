<?php $this->titre = 'Accueil'; ?>

<h1>Liste de billets</h1>
<?php foreach($billets as $billet) : ?>

    <article>
        <header>
            <h2 class="titreBillet">
                <a href="index.php?controleur=billet&action=billet&id=<?= $billet['id'] ?>"> <?= $billet['bil_titre'] ?> </a>

                <!-- 
                    grace a la réécriture d'url , on passe d'un ce chemin
                            
                        <a href="index.php?controleur=billet&action=billet&id=<?//= $billet['id'] ?>"> <?//= $billet['bil_titre'] ?> </a>
                    
                    a ce chemin qui est beaucoup plus propre

                        <a href="billet/billet/<?//= $billet['id'] ?>"> <?//= $billet['bil_titre'] ?> </a>
                 -->
                <!-- <a href="Billet/billet/<?= $billet['id'] ?>"> <?= $billet['bil_titre'] ?> </a> -->
            </h2>
            <time><?= $billet['bil_date'] ?></time>
        </header>
        <p><?= $billet['bil_contenu'] ?></p>
    </article>

<?php endforeach; ?>
    