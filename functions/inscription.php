<?php

require_once "../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    // if ($email === "") {
    //     $emailErr = "erreur email vide";
    // } elseif (filter_var($email_a, FILTER_VALIDATE_EMAIL) !== true) {
    //     $emailErr = "erreur email valide";
    // }


    // if ($pseudo === "") {
    //     $pseudoErr = "erreur email";
    // }

    // if ($password === "") {
    //     $passwordErr = "erreur email";
    // }

    // if ($passwordConfirm === "") {
    //     $passwordConfirmErr = "erreur email";
    // }

    if ($password !== "" && $passwordConfirm !== "" && $pseudo !== "" && $email !== "") {
        if ($password === $passwordConfirm) {
            $passwordEncoded = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare('INSERT INTO members (email, pseudo, password) VALUES (:email, :pseudo, :password)');
            $stmt->bindParam('email', $email);
            $stmt->bindParam('pseudo', $pseudo);
            $stmt->bindParam('password', $passwordEncoded);

            $stmt->execute();
        }
    } else {
        header('Location: /inscription');
    }
}