<?php
$input = file("input.txt", FILE_IGNORE_NEW_LINES);
$lines = [];
$y = 1;

foreach($input as $row) {
    for($x = 0; $x < strlen($row); $x++) {
        $lines[$x+1][$y] = (substr($row, $x, 1) == "#") ? true : false;
    }
    $y++;
}

for($i = 0; $i < 100; $i++) {
    $nextLine = [];
    for($x = 1; $x <= count($lines); $x++) {
        for($y = 1; $y <= count($lines[1]); $y++) {
            $neighbourLamp = 0;
            for($a = $x-1; $a <= $x+1; $a++) {
                for($b = $y-1; $b <= $y+1; $b++) {
                    if(isset($lines[$a][$b]) && (($a != $x) || ($b != $y))) {
                        if($lines[$a][$b]) $neighbourLamp++;
                    }
                }
            }
            if($lines[$x][$y]) {
                $nextLine[$x][$y] = (($neighbourLamp == 2) || ($neighbourLamp == 3)) ? true : false;
            } else {
                $nextLine[$x][$y] = ($neighbourLamp == 3) ? true : false;
            }
        }
    }
    $lines = $nextLine;

    //Four Lines for a part two.
    $lines[1][1] = true;
    $lines[1][100] = true;
    $lines[100][1] = true;
    $lines[100][100] = true;
}

$lightsOn = 0;
for($x = 1; $x <= count($lines); $x++) {
    for($y = 1; $y <= count($lines[1]); $y++) {
        if($lines[$x][$y]) {
            $lightsOn++;
        }
    }
}
echo "There're " . $lightsOn . " lights enlightened." . PHP_EOL;
?>
