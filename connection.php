<?php


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connection</title>
    <link rel="stylesheet" href="design/default.css" type="text/css">
</head>
<body>
    <header>
       <h1>Connexion</h1> 
    </header>
    <div class="container">
        <p class="info">Bienvenue sur mon site, si vous n'êtes pas inscrit, <a href="./">inscrivez-vous</a> .</p>
        <div class="form">
            <form action="index.php" method="post">
                <table>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" placeholder="example@google.fr"></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" name="password" placeholder="Votre mot de passe"></td>
                    </tr>       
                </table>
                <div class="button">
                        <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
       
    </div>
    
</body>
</html>
