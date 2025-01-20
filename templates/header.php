<!doctype html>
<html>
<head>
    <title>Quiz</title>
</head>
<body>
<?php if (isset($_SESSION['utilisateur'])) : ?>
    <div>
        Connecté en tant que : <?php echo htmlspecialchars($_SESSION['utilisateur']); ?><br>
        <a href="index.php?action=logout">Déconnexion</a>
    </div>
<?php endif; ?>
