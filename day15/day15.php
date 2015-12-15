<?php
$input = file_get_contents("input.txt");
preg_match_all("/.* (-?\d+).* (-?\d+).* (-?\d+).* (-?\d+).* (-?\d+).*/", $input, $matches, PREG_SET_ORDER);

function baseCalc($base, $i, $ing) {
    return (($inp = $base + $i * $ing) > 0) ? $inp : 0;
}

function cookieFormula($matches, $spoonMax, &$results = [], $calcd = null, $cap = 0, $dur = 0, $flav = 0, $tex = 0, $ccal = 0) {
    $x = array_pop($matches);
    if(!count($matches)) {
        if(null == $calcd || $calcd == $ccal + $spoonMax * $x[5]) {
            return $results[] = baseCalc($cap, $x[1], $spoonMax) * baseCalc($dur, $x[2], $spoonMax) * baseCalc($flav, $x[3], $spoonMax) * baseCalc($tex, $x[4], $spoonMax);
        } else {
            return;
        }
    }
    for($i = 1; $i < $spoonMax; $i++) {
        cookieFormula($matches, $spoonMax-$i, $results, $calcd, $cap+$i*$x[1], $dur+$i*$x[2], $flav+$i*$x[3], $tex+$i*$x[4], $ccal+$i*$x[5]);
    }
}
cookieFormula($matches, 100, $partOne);
cookieFormula($matches, 100, $partTwo, 500);

echo "Part One: " . max($partOne) . " Part Two: " . max($partTwo) . PHP_EOL;
?>
