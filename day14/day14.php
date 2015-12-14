<?php
$input = file_get_contents("input.txt");
preg_match_all("/([A-Za-z]+) [^\d]*?(\d+)[^\d]*?(\d+)[^\d]*?(\d+)/", $input, $matches);

function posWinning($speeds, $times, $breaks, $n) {
    foreach($speeds as $j => $speed) {
        for($i = 0, $k = $n, $position[$j] = 0; $k > 0; $i++) {
            if($i % 2 == 0) {
                $position[$j] += ($k > $times[$j]) ? $speeds[$j] * $times[$j] : $speeds[$j] * $k;
                $k -= $times[$j];
            } else {
                $k -= $breaks[$j];
            }
        }
        return $position;
    }
}

$position = posWinning($matches[2], $matches[3], $matches[4], 2503);
for ($i = 1, $points = []; $i <= 2503; $i++) {
    $tmpPos = posWinning($matches[2], $matches[3], $matches[4], $i);
    $keys = array_keys($tmpPos, max($tmpPos));
    foreach ($keys as $k) $points[$k] = isset($points[$k]) ? $points[$k] + 1 : 1;
}

echo "Part One: " . max($position) . " Part Two: " . max($points);

?>
