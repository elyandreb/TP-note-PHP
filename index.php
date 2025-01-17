<?php

require_once __DIR__ . '/Classes/autoload.php';

use function BD\init_bd;

session_start();

try {
    $bd = init_bd();
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
