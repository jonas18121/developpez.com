<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
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