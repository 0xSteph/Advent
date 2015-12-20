<?php
$input = file_get_contents("input.txt");
preg_match_all("/(.+) => (.+)/", $input, $replacements, PREG_SET_ORDER);
preg_match("/^[^\>]+$/m", $input, $text);
$rudolphMed = trim(current($text));

foreach($replacements as $rep) {
    for($len = strlen($rep[1]), $pos = 0; ($pos = strpos($rudolphMed, $rep[1], $pos)) !== false; $pos += $len) {
        $result[substr_replace($rudolphMed, $rep[2], $pos, $len)] = 0;
    }
}

function findMedis($replacements, $rudolphMed, $current, &$results, $step = 0) {
    foreach($replacements as $rep) {
        if(($pos = strpos($rudolphMed, $rep[2])) !== false && $cur = substr_replace($rudolphMed, $rep[1], $pos, strlen($rep[2]))) {
            if($cur == $current) {
                return $results[$step + 1] = 0;
            }
            if (strlen($cur) < 1) {
                continue;
            }
            return findMedis($replacements, $cur, $current, $results, $step + 1);
        }
    }
}

findMedis($replacements, $rudolphMed, "e", $results);
echo "Part One: " . count($result) . " Part Two: " . min(array_keys($results)) . PHP_EOL;
?>
