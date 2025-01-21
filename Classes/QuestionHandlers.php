<?php

namespace Classes;
class QuestionHandlers
{
    public static function question_text($q)
    {
        echo ($q["text"] . "<br><input type='text' name='{$q["name"]}'><br>");
    }

    public static function question_radio($q)
    {
        $html = $q["text"] . "<br>";
        $i = 0;
        foreach ($q["choices"] as $c) {
            $i += 1;
            $html .= "<input type='radio' name='{$q["name"]}' value='{$c["value"]}' id='{$q["name"]}-$i'>";
            $html .= "<label for='{$q["name"]}-$i'>{$c["text"]}</label><br>";
        }
        echo $html;
    }

    public static function question_checkbox($q)
    {
        $html = $q["text"] . "<br>";
        $i = 0;
        foreach ($q["choices"] as $c) {
            $i += 1;
            $html .= "<input type='checkbox' name='{$q["name"]}[]' value='{$c["value"]}' id='{$q["name"]}-$i'>";
            $html .= "<label for='{$q["name"]}-$i'>{$c["text"]}</label><br>";
        }
        echo $html;
    }

    public static function answer_text($q, $v)
    {
        return $q["answer"] === $v ? $q["score"] : 0;
    }

    public static function answer_radio($q, $v)
    {
        return $q["answer"] === $v ? $q["score"] : 0;
    }

    public static function answer_checkbox($q, $v)
    {
        $diff1 = array_diff($q["answer"], is_array($v) ? $v : []);
        $diff2 = array_diff(is_array($v) ? $v : [], $q["answer"]);
        return (count($diff1) === 0 && count($diff2) === 0) ? $q["score"] : 0;
    }
}
