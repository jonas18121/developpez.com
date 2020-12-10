<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--
        Lors de réécriture d'url , on met la balise base, 
        afin d'évité des erreurs d'inclusion de feuilles de style, d'images, de fichiers JavaScript, etc.  
    -->
    <!-- <base href="<?//= $racine_web ?>" >  -->
    <?php //pre_var_dump('L 11 gabarit.php', $_SERVER ); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../../css/style.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!-- <link type="text/css" rel="stylesheet" href="/afpa_developpement/code/poo/MVC/developpez.com/css/style.css"> -->
    <title><?= $titre ?></title>
</head>
<body>
    <div id=global>
        <header>
            <a href="index.php"><h1 id="titreblog">Mon blog</h1></a>
            <p>Je vous souhaite la bienvenue sur ce modeste blog </p>
        </header>

        <div id="contenu">
            <?= $contenu ?>
        </div>
        
        <footer id='piedBlog'>
            Blog 
        </footer>
    </div>
</body>
</html>