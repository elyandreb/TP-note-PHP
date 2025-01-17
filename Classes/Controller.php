<?php


class Controller
{
    private $questions;
    private $type;

    public function __construct($questions)
    {
        $this->questions = $questions;
        $this->type = [
            "text" => [QuestionHandlers::class, "question_text"],
            "radio" => [QuestionHandlers::class, "question_radio"],
            "checkbox" => [QuestionHandlers::class, "question_checkbox"]
        ];
    }

    public function showQuiz()
    {
        echo "<form method='POST' action='index.php?action=submitQuiz'><ol>";
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

        foreach ($this->questions as $q) {
            $handler = [QuestionHandlers::class, "answer_{$q["type"]}"];
            $scoreTotal += $q["score"];
            $scoreCorrect += call_user_func($handler, $q, $answers[$q["name"]] );
        }
        echo "<p>Votre score : $scoreCorrect / $scoreTotal</p>";
        echo "<a href='index.php'>Recommencer</a>";
    }
}
