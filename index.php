<?php

require_once __DIR__ . '/Classes/autoload.php';


session_start();
use Classes\Controller;
use Classes\Provider;
use BD\model_bd;


try {
    $action = $_GET['action'] ?? 'home';
    $quiz = $_GET['quiz'] ?? 'questions'; 
    echo "Le quiz sélectionné est : " . htmlspecialchars($quiz); 

    $bd = new model_bd();

    if ($action === 'home') {
        require_once __DIR__ . '/templates/quiz.php';
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