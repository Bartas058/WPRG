<?php

function validateWords($text) {
    $words_array = explode(" ", $text);
    $validated_array = array();

    $punctuation_chars = [".", ",", "?", "'", ":", "(", ")", "-", "...", "/", "!"];

    foreach ($words_array as $word) {
        $contains_punctuation_char = false;
        foreach ($punctuation_chars as $char) {
            if (strpos($word, $char) !== false) {
                $contains_punctuation_char = true;
                break;
            }
        }
        if (!$contains_punctuation_char) {
            $validated_array[] = $word;
        }
    }
    
    return $validated_array;
}

function createAssociativeArray($validated_array) {
    $associative_array = array();

    foreach ($validated_array as $key => $value) {
        if ($key % 2 == 0 && isset($validated_array[$key + 1])) {
            if (isset($associative_array[$value])) {
                continue;
            }
            $associative_array[$value] = $validated_array[$key + 1];
        }
    }

    return $associative_array;
}

function printAssociativeArray($associative_array) {
    foreach ($associative_array as $key => $value) {
        echo "$key => $value\n";
    }
}

$text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

$validated_array = validateWords($text);
$associative_array = createAssociativeArray($validated_array);
printAssociativeArray($associative_array);

?>