<?php

namespace Classes;
class Controller
{
    private $questions;
    private $type;
    private $currentQuiz;

    public function __construct($questions)
    {
        $this->questions = $questions;
        $this->currentQuiz = $_GET['quiz'] ?? 'questions';
        $this->type = [
            "text" => [QuestionHandlers::class, "question_text"],
            "radio" => [QuestionHandlers::class, "question_radio"],
            "checkbox" => [QuestionHandlers::class, "question_checkbox"]
        ];
    }

    public function showQuiz()
    {
        $quiz = $_GET['quiz'] ?? 'questions';
        echo "<h1>Le quiz selectionné est ".$quiz." </h1>";
        echo "<form class=quiz-container method='POST' action='index.php?action=submitQuiz&quiz={$this->currentQuiz}'><ol>";
        foreach ($this->questions as $q) {
            echo "<li>";
            call_user_func($this->type[$q["type"]], $q);
        }
        echo "</ol><input type='submit' value='Envoyer'></form>";
    }

    public function submitQuiz($answers)
    {
        $scoreTotal = 0;
        $scoreCorrect = 0;
        $username = $_SESSION['utilisateur'] ?? 'anonymous';
        $bd = new \BD\model_bd();

        foreach ($this->questions as $q) {
            if (isset($answers[$q["name"]])) {  // Vérification que la réponse existe
                $handler = [QuestionHandlers::class, "answer_{$q["type"]}"];
                $scoreTotal += $q["score"];
                $scoreUser = call_user_func($handler, $q, $answers[$q["name"]]);
                $scoreCorrect += $scoreUser;
                $bd->add_score($username, $scoreUser, $q["score"], $q["text"]);
            }
        }

        include __DIR__ . '/../templates/header.php';
        echo "<p>Votre score : $scoreCorrect / $scoreTotal</p>";
        echo "<a href='templates/scores.php'>Voir mes scores</a><br>";
        echo "<a href='index.php'>Recommencer</a>";
    }
}