<?php
$input = "3113322113";

function elfLookSay($sequence) {
    for($i = $count = 0, $result = "", $n = $sequence[0], $length = strlen($sequence); $i < $length; $i++) {
        if($n == $sequence[$i]) $count++;
        else {
            $result .= $count . $sequence[$i-1];
            $count = 1;
            $n = $sequence[$i];
        }
    }
    return $result . $count . $sequence[$i-1];
}

function elfLookSayGet($value, $n) {
    for($i = 0; $i < $n; $i++) $value = elfLookSay($value);
    return strlen($value);
}

echo "Part One: " . elfLookSayGet($input, 40) . " Part Two: " . elfLookSayGet($input, 50) . PHP_EOL;
?>
