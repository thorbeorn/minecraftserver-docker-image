<?php
    session_start();
    require_once 'config.php';

    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT pseudo, password FROM _user WHERE pseudo = :pseudo');
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $data = $stmt->fetch();
        $row = $stmt->rowCount();

        if ($row > 0) {
            if (password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data['pseudo'];
                header('Location: dashboard.php');
                exit();
            } else {
                header('Location: index.php?login_err=password');
                exit();
            }
        } else {
            header('Location: index.php?login_err=already');
            exit();
        }
    } else {
        header('Location: index.php');
        exit();
    }
?>
