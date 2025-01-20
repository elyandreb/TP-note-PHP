<?php
session_start();
require_once __DIR__ . '/../Classes/autoload.php';
use BD\model_bd;

$bd = new model_bd();
$username = $_SESSION['utilisateur'] ?? 'anonymous';
$scores = $bd->give_user_score($username);

echo "<h3>Historique de mes scores :</h3>";
    if (!empty($scores)) {
        foreach ($scores as $score) {
            echo "Quiz : {$score['Question']} - Score : {$score['Score']}/{$score['ScoreMax']}<br><br>";
        }
    }
    else {
        echo "Aucun score disponible. <a href='index.php'>Faire le quiz</a>";
    }
echo "<a href='../index.php'> Revenir à l'accueil </a>"
?> 