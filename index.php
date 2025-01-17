<?php

require_once __DIR__ . '/Classes/autoload.php';

use BD\model_BD;

session_start();

try {
    $bd = new model_BD();
    $questions = Provider::getQuestions();
    $controller = new Controller($questions);

    $action = $_GET['action'] ?? 'showQuiz';

    if ($action === 'showQuiz') {
        $controller->showQuiz();
    } 
    elseif ($action === 'submitQuiz') {
        $answers = $_POST;
        $controller->submitQuiz($answers);
    } 
    
} catch (Exception $e) {
    echo "<p>Erreur : " . $e->getMessage() . "</p>";
}
