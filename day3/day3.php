<?php
$input = file_get_contents("input.txt");

$arrInput = str_split($input);

$santaPos = $santa2Pos = $robotPos = [];
$santaX = $santaY = $santa2X = $santa2Y = $robotX = $robotY = 0;

foreach($arrInput as $turn => $dir) {
    switch($dir) {
        case "^":
            $turn % 2 == 0 ? $santaY++ : $robotY++;
            $santa2Y++;
            break;
        case ">":
            $turn % 2 == 0 ? $santaX++ : $robotX++;
            $santa2X++;
            break;
        case "v":
            $turn % 2 == 0 ? $santaY-- : $robotY--;
            $santa2Y--;
            break;
        case "<":
            $turn % 2 == 0 ? $santaX-- : $robotX--;
            $santa2X--;
            break;
    }
    $santaPos[] = $santaX . ", " . $santaY;
    $robotPos[] = $robotX . ", " . $robotY;
    $santa2Pos[] = $santa2X . ", " . $santa2Y;
}

$visitedS = array_count_values($santaPos);
$visitedR = array_count_values($robotPos);
$sumVisitedS = array_count_values($santa2Pos);

$sumVisitedSR = array_merge($visitedS, $visitedR);

echo "Santa: " . count($sumVisitedS) . " Santa and Robot: " . count($sumVisitedSR);
?>
