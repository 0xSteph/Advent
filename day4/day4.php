<?php

$input = "iwrupvqb";

$fiveZero = 0;
$sixZero = 0;

while(strpos(md5("$input$fiveZero"), "00000") !== 0) {
    $fiveZero++;
}

while(strpos(md5("$input$sixZero"), "000000") !== 0) {
    $sixZero++;
}

echo "Part One: " . $fiveZero . "<br />Part Two: " . $sixZero . PHP_EOL;

?>
