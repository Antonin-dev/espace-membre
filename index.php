<?php
session_start();

require('src/config.php');

if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {

    // Controle des données
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    $user = new User($pseudo, $email, $password, $confirmPassword);
    $db = new Database();

    // Controle si les mots de passe correspondent
    if ($user->passwordControl() == false) {
        header('location: ./?error=1&pass=1');
        exit();
    }

    // Controle si l'adresse email est déja en bdd 
    if ($db->emailControl($user->getEmail())["COUNT(*)"] != 0) {
        header('location: ./?error=1&email=1');
        exit();
    }

    // Insertion en bdd
    $db->userInsert($user);
    header('location: ./?success=1');
    exit();


}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de connection</title>
    <link rel="stylesheet" href="design/default.css" type="text/css">
</head>

<body>
    <header>
      <h1>Inscription</h1>  
    </header>
    
    <div class="container">
    
        <?php

        if (!isset($_SESSION['connect'])) {
        ?>  
        <p class="info">Bienvenue sur mon site pour en voir plus, inscrivez-vous. Sinon <a href="connection.php">connectez vous</a> .</p>

        <?php
        
            if (isset($_GET['error'])) {

                if (isset($_GET['pass'])) {
                    echo '<p class="error">Les mots de passe ne sont pas identique .</p>';
                }elseif (isset($_GET['email'])) {
                    echo '<p class="error">Cette adresse email est déja prise .</p>';
                }
            }
            if (isset($_GET['success'])){
                echo '<p class="success">Votre inscription est validé .</p>';
            }
        ?>

        <div class="form">
            <form action="index.php" method="post">
                <table>
                    <tr>
                        <td>Pseudo</td>
                        <td><input type="text" name="pseudo" placeholder="Baboulinet" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" placeholder="example@google.fr" required></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" name="password" placeholder="Votre mot de passe" required></td>
                    </tr>
                    <tr>
                        <td>Confirmer mot de passe</td>
                        <td><input type="password" name="confirmPassword" placeholder="Confirmer mot de passe" required></td>
                    </tr>           
                </table>
                <div class="button">
                    <button type="submit">Inscription</button>
                </div>
            </form>
        </div>
        <?php
        }else{?>
           
           <p class="info">Bienvenue sur mon site <?=$_SESSION['pseudo']?>
           <br>
           <a href="deconnection.php">Déconnexion</a>
           </p>

        <?php }
        ?>
    </div>
</body>

</html>