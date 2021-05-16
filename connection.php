<?php

session_start();

if (isset($_SESSION['connect'])) {
    header('location: ./');
    exit();
}

require('src/config.php');

if (isset($_POST['email']) && isset($_POST['password'])) {

    $db = new Database();

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    $user = $db->getUser($email);

    
    if (password_verify($password, $user->users_password)) {
        $_SESSION['connect'] = 1;
        $_SESSION['pseudo'] = $user->users_pseudo;

        if (isset($_POST['connect'])) {
            setcookie('log', $user->users_key, time()+(3600*24*365), '/', null, false, true);
            
        }

        header('location: ./connection.php?success=1');
        exit();
    }
    else {
        header('location: ./connection.php?error=1');
        exit();
    }
}

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
        <?php
            if (isset($_GET['error'])) {
                echo '<p class="error">Adresse email ou mot de passe invalide .</p>';
            }else if (isset($_GET['success'])) {
                echo '<p class="success">Vous êtes connecté .</p>';
            }
        ?>
        <div class="form">
            <form action="connection.php" method="post">
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
                <p><label><input type="checkbox" name="connect" checked>Connexion automatique</label></p>
                <div class="button">
                        <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
       
    </div>
    
</body>
</html>
