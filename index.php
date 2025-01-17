<?php

require_once __DIR__ . '/Classes/autoload.php';



session_start();

try {
    $questions = Provider::getQuestions();
    $controller = new Controller($questions);

    $action = $_GET['action'] ?? 'showQuiz';

    if ($action === 'showQuiz') {
        $controller->showQuiz();
    } 
} catch (Exception $e) {
    echo "<p>Erreur : " . $e->getMessage() . "</p>";
}
