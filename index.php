<?php

require_once __DIR__ . '/Classes/autoload.php';

use Classes\Controller;
use Classes\Provider;
use BD\model_bd;

session_start();

try {
    $bd = new model_bd();
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
