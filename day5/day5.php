<?php
$input = file("input.txt");

$niceStrings = 0;
$niceStrings2 = 0;

foreach($input as $string) {
    if(preg_match('#(?=.*(.)\1)(?=(.*[aeiou]){3})#', $string) && !preg_match('#(ab|cd|pq|xy)#', $string)) {
        $niceStrings++;
    }
    if(preg_match('#(?=.*(..).*\1)(?=.*(.).\2)#', $string)) {
        $niceStrings2++;
    }
}

echo "Part One: " . $niceStrings . " Part Two: " . $niceStrings2 . PHP_EOL;

?>
