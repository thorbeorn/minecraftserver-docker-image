<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['pseudo']) && !empty($_POST['password'])) // Si il existe les champs pseudo, password et qu'ils ne sont pas vides
    {
        // Patch XSS
        $pseudo = htmlspecialchars($_POST['pseudo']); 
        $password = htmlspecialchars($_POST['password']);
        
        $pseudo = strtolower($pseudo); // pseudo transformé en minuscule
        
        // On vérifie si l'utilisateur est inscrit dans la table _user
        $check = $pdo->prepare('SELECT pseudo, password FROM _user WHERE pseudo = ?');
        $check->execute(array($pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mot de passe est correct
            if(password_verify($password, $data['password']))
            {
                // On crée la session et on redirige vers dashboard.php
                $_SESSION['user'] = $data['pseudo'];
                header('Location: dashboard.php');
                die();
            } else {
                header('Location: index.php?login_err=password');
                die();
            }
        } else {
            header('Location: index.php?login_err=already');
            die();
        }
    } else {
        header('Location: index.php');
        die();
    } 
?>