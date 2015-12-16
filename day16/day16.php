<?php
$input = file("input.txt", FILE_IGNORE_NEW_LINES);
$sues = [];
$bluesClues = ["children" => 3, "cats" => 7, "samoyeds" => 2, "pomeranians" => 3, "akitas" => 0, "vizslas" => 0, "goldfish" => 5, "trees" => 3, "cars" => 2, "perfumes" => 1];

foreach($input as $key => $val) {
    $regEx = "/Sue (\\d+): (\\w*): (\\d+)\\, (\\w*): (\\d+)\\, (\\w*): (\\d+)/";
    preg_match($regEx, $val, $matches);
    list(, $number, $item_1, $val_1, $item_2, $val_2, $item_3, $val_3) = $matches;
    $sues[$number] = [$item_1 => (int) $val_1, $item_2 => (int) $val_2, $item_3 => (int) $val_3];
}

foreach($sues as $partOne => $data) {
    $correct = true;
    foreach($data as $name => $val) {
        if($bluesClues[$name] !== $val) {
            $correct = false;
            break;
        }
    }
    if($correct) {
        echo "Part One: " . $partOne;
    }
}

foreach($sues as $partTwo => $data) {
    $correct = true;
    foreach($data as $name => $val) {
        if(in_array($name, ["cats", "trees"])) {
            $correct = $bluesClues[$name] < $val;
        } elseif(in_array($name, ["pomeranians", "goldfish"])) {
            $correct = $bluesClues[$name] > $val;
            if(!$correct) break;
        } elseif($bluesClues[$name] !== $val) {
            $correct = false;
            break;
        }
    }
    if($correct) {
        echo " Part Two: " . $partTwo;
    }
}
?>
