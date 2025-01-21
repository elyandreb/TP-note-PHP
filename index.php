<?php
require_once __DIR__ . '/Classes/autoload.php';

session_start();
use Classes\Controller;
use Classes\Provider;
use BD\model_bd;

try {
    $action = $_GET['action'] ?? 'home';
    $quiz = $_GET['quiz'] ?? 'questions';

    // Gérer le logout en premier
    if ($action === 'logout') {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Gérer le login
    if ($action === 'login') {
        if (!empty($_POST['username'])) {
            $_SESSION['utilisateur'] = htmlspecialchars($_POST['username']);
            header('Location: index.php?action=home');
            exit;
        }
    }

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['utilisateur'])) {
        // Afficher le formulaire de login
        echo <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Login</title>
        </head>
        <body>
            <form method="POST" action="index.php?action=login">
                <label for="username">Votre nom :</label>
                <input type="text" id="username" name="username" required>
                <input type="submit" value="Commencer">
            </form>
        </body>
        </html>
HTML;
        exit;
    }

    // Si l'utilisateur est connecté, continuer avec le quiz
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
}  
catch (Exception $e) {
    echo "<p>Erreur : " . $e->getMessage() . "</p>";
}
?>