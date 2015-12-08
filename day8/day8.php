<?php
$input = file("input.txt", FILE_IGNORE_NEW_LINES);
$chars = 0;
$charsNew = 0;

foreach($input as $line) {
    eval('$str = ' . $line . ';');
    $chars += strlen($line) - strlen($str);

    $charsNew += strlen('"'.addslashes($line).'"') - strlen($line);
}

echo "Part One: " . $chars . " Part Two: " . $charsNew . PHP_EOL;

?>
