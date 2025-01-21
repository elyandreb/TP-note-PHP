<?php
// templates/login.php 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Quiz</title>
</head>
<body>
    <div class="login-container">
        <h2>Bienvenue sur le Quiz</h2>
        <form method="POST" action="index.php?action=login">
            <div class="form-group">
                <label for="username">Votre nom :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <input type="submit" value="Commencer">
        </form>
    </div>
</body>
</html>