<?php
include __DIR__ . '/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix du Quiz</title>
    <link rel="stylesheet" href="templates/styles/quiz.css">
</head>
<body>
    <header>
        <h1>Choisissez un Quiz</h1>
    </header>
    <main>
        <section class="quiz-selection">
            <ul class="quiz-list">
                <li><a href="index.php?action=home&quiz=questions" class="quiz-link">Quiz 1</a></li>
                <li><a href="index.php?action=home&quiz=animaux" class="quiz-link">Quiz Animaux</a></li>
            </ul>
        </section>
    </main>
</body>
</html>