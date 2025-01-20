<?php

namespace Classes;

use \Exception;

class Provider{
    public static function getQuestions()
    {
        $source = 'data/questions.json';
        $content = file_get_contents($source);
        $questions = json_decode($content, true);

        if (empty($questions)) {
            throw new Exception('No questions :(', 1);
        }

        return $questions;
    }
}