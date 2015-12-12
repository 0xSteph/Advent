<?php
$input = file_get_contents("input.txt");

function sumUp($json) {
    preg_match_all("/-?\d+/", $json, $matches);
    return array_sum($matches[0]);
}

function sumUpP2($input) {
    foreach ($input as &$item) {
        if (is_object($input) && is_string($item) && $item == "red") return null;
        if(is_object($item) || is_array($item)) $item = sumUpP2($item, is_object($item));
    }
    return $input;
}
echo "Part One: " . sumUp($input) . " Part Two: " . sumUp(json_encode(sumUpP2(json_decode($input))));
?>
