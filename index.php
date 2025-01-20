<?php

require_once __DIR__ . '/Classes/autoload.php';


session_start();
use Classes\Controller;
use Classes\Provider;
use BD\model_bd;


try {
    while (!isset($_SESSION['utilisateur'])) {
        echo <<<FORM
        <form method="POST" action="index.php?action=login">
        <label for="username">Votre nom :</label>
            <input type="text" id="username" name="username" required>
            <input type="submit" value="Commencer">
        </form>
    FORM;
    }
    
    $action = $_GET['action'] ?? 'home';
    $quiz = $_GET['quiz'] ?? 'questions'; 
    echo "Le quiz sélectionné est : " . htmlspecialchars($quiz); 

    $bd = new model_bd();


    if ($action === 'login') {
        $_SESSION['utilisateur'] = $_POST['username'];
        $action='home';
        exit;
    }

    if ($action === 'logout') {
        session_destroy();
        header('Location: index.php');
        exit;
    }

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
}  
catch (Exception $e) {
    echo "<p>Erreur : " . $e->getMessage() . "</p>";
}
?>