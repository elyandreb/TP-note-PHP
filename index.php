<?php

require_once __DIR__ . '/Classes/autoload.php';

session_start();


if (isset($_GET['quiz'])) {
    $quiz = $_GET['quiz'];
    echo "Le quiz sélectionné est : " . htmlspecialchars($quiz);
}

try {
    $action = $_GET['action'] ?? 'home';

    if ($action === 'home') {
        require_once __DIR__ . '/templates/home.php';
        $action = 'showQuiz';
    }

    $questions = Provider::getQuestions($quiz);
    $controller = new Controller($questions);

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