<?php
session_start();
require_once __DIR__ . '/../Classes/autoload.php';
use BD\model_bd;

$bd = new model_bd();
$username = $_SESSION['utilisateur'] ?? 'anonymous';
$scores = $bd->give_user_score($username);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Scores</title>
    <link rel="stylesheet" href="styles/scores.css">
</head>
<body>
    <header>
        <h1>Mes Scores</h1>
    </header>
    <main>
        <section class="scores-container">
            <?php if (!empty($scores)): ?>
                <ul class="scores-list">
                    <?php foreach ($scores as $score): ?>
                        <li>
                            Quiz : <?= htmlspecialchars($score['Question']) ?> - 
                            Score : <?= htmlspecialchars($score['Score']) ?>/<?= htmlspecialchars($score['ScoreMax']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun score disponible. <a href="index.php">Faire le quiz</a></p>
            <?php endif; ?>
            <a href="../index.php" class="btn">Revenir à l'accueil</a>
        </section>
    </main>
</body>
</html>
