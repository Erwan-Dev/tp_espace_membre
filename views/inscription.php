<div class="d-flex">
        <form action="../functions/inscription.php" method="POST" class="p-5">
            <div class="form-group">
                <label for="email">Votre E-Mail</label>
                <input type="email" class="form-control" name="email" required>
            </div>
        
            <div class="form-group">
                <label for="pseudo">Votre pseudo</label>
                <input type="text" class="form-control" name="pseudo" required>
            </div>
    
            <div class="form-group">
                <label for="password">Votre mot de passe</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="password">Confirmation de votre mot de passe</label>
                <input type="password" class="form-control" name="passwordConfirm" required>
            </div>
            
            <button class="btn btn-primary" type="submit">Envoyer</button>
        </form>
</div>