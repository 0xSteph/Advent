<?php
$input = file("input.txt", FILE_IGNORE_NEW_LINES);
sort($input);

function eggnogContainer(&$input, $inpSum, $totalLit, &$partOne, &$partTwo, $i = 0, $number = 0) {
    if($totalLit == 0) {
        return $partOne++ && $partTwo[$number] = isset($partTwo[$number]) ? $partTwo[$number] + 1 : 1;
    }
    if($i >= $inpSum || $totalLit < 0) return;
    eggnogContainer($input, $inpSum, $totalLit - $input[$i], $partOne, $partTwo, $i + 1, $number + 1);
    eggnogContainer($input, $inpSum, $totalLit, $partOne, $partTwo, $i + 1, $number);
}

eggnogContainer($input, count($input), 150, $partOne, $partTwo, 0);
ksort($partTwo);
echo "Part One: " . $partOne . " Part Two: " . current($partTwo);
?>
