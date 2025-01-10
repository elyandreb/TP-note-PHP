<?php

function getQuestions()
{
    $source = 'data/questions.json';
    $content = file_get_contents($source);
    $products = json_decode($content, true);

    if (empty($products)) {
        throw new Exception('No questions :(', 1);
    }

    return $products;
}