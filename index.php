<?php

require_once __DIR__ . '/classes/autoload.php';

use Question\Controller;
use Question\Provider;



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
