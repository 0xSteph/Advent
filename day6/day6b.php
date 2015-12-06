<?php
$input = file("input.txt");

$lightsOff = array_fill(0, 1000, array_fill(0, 1000, false));

foreach($input as $key => $inst) {
    if(!preg_match('/(on|off|toggle) (\d+),(\d+) through (\d+),(\d+)/', $inst, $i)) die('input failure!');

    $fn = $i[1];
    $x1 = intval($i[2]);
    $y1 = intval($i[3]);
    $x2 = intval($i[4]);
    $y2 = intval($i[5]);

    for($x = min($x1,$x2); $x <= max($x1,$x2); $x++) {
        for($y = min($y1,$y2); $y <= max($y1,$y2); $y++) {

            if($fn == "on") $lightsOff[$x][$y] = max(0, $lightsOff[$x][$y] + 1);
            elseif($fn == "off") $lightsOff[$x][$y] = max(0, $lightsOff[$x][$y] - 1);
            elseif($fn == "toggle") $lightsOff[$x][$y] = max(0, $lightsOff[$x][$y] + 2);
        }
    }
}

$brightness = 0;
foreach($lightsOff as $x => $row) {
    foreach($row as $y => $light) {
        $brightness += $light;
    }
}

echo "Total brightness: " . $brightness . PHP_EOL;
?>
