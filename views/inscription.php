<?php

include_once "../partials/header.php";
include_once "../partials/navbar.php";

require_once "../database/connection.php";

    $emailErr = null;
    $pseudoErr = null;
    $passwordErr = null;
    $passwordConfirmErr = null;

    $email =  null;
    $pseudo =  null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];


    if ($email === "") {
        $emailErr = "L'email est obligatoire";
    } 

    if ($pseudo === "") {
        $pseudoErr = "Le pseudo est obligatoire";
    }

    if ($password === "") {
        $passwordErr = "Le mot de passe est obligatoire";
    }

    if ($passwordConfirm === "") {
        $passwordConfirmErr = "Vous devez confirmer votre mot de passe";
    }

    if ($password !== "" && $passwordConfirm !== "" && $pseudo !== "" && $email !== "") {
        if ($password === $passwordConfirm) {
            $passwordEncoded = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare('INSERT INTO members (email, pseudo, password) VALUES (:email, :pseudo, :password)');
            $stmt->bindParam('email', $email);
            $stmt->bindParam('pseudo', $pseudo);
            $stmt->bindParam('password', $passwordEncoded);

            $stmt->execute();
        } else {
            $passwordErr = $passwordConfirmErr = "Les mots de passe ne correspondent pas";
        }
    }
}
?>

<div class="d-flex">
        <form action="" method="POST" class="p-5" autocomplete="off">
            <input type="hidden" autocomplete="false">
            <div class="form-group">
                <label for="email">Votre E-Mail</label>
                <input type="email" class="form-control <?= $emailErr ? 'border border-danger' : ''?>" name="email" value="<?= $email ?>">
                <?= $emailErr ? "<span class='text-danger'>$emailErr</span>" : ""?>
            </div>
        
            <div class="form-group">
                <label for="pseudo">Votre pseudo</label>
                <input type="text" class="form-control  <?= $pseudoErr ? 'border border-danger' : ''?>"  name="pseudo" value="<?= $pseudo ?>">
                <?= $pseudoErr ? "<span class='text-danger'>$pseudoErr</span>" : ""?>
            </div>
    
            <div class="form-group">
                <label for="password">Votre mot de passe</label>
                <input type="password" class="form-control  <?= $passwordErr ? 'border border-danger' : ''?>"  name="password">
                <?= $passwordErr ? "<span class='text-danger'>$passwordErr</span>" : ""?>
            </div>

            <div class="form-group">
                <label for="password">Confirmation de votre mot de passe</label>
                <input type="password" class="form-control <?= $passwordConfirmErr ? 'border border-danger' : ''?>" name="passwordConfirm">
                <?= $passwordConfirmErr ? "<span class='text-danger'>$passwordConfirmErr</span>" : ""?>
            </div>
            
            <button class="btn btn-primary" type="submit">Envoyer</button>
        </form>
</div>

<?php
include_once "../partials/footer.php";
?>