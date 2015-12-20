<?php
$input = "34000000";

function houseNumber($required, $housesMax = null) {
    for($presents = $house = 0; $presents < $required; $house++) {
        $presents = elfPresents($house, $housesMax);
    }
    return --$house;
}

function elfPresents($house, $housesMax = null) {
    for ($i = 2, $ret = 1, $c = sqrt($house); $i <= $c && ! ($housesMax !== null && --$housesMax < 1); $i++) {
        if($house % $i == 0) {
            if(($ret += $i) && $i != $house / $i) {
                $ret += $house / $i;
            }
        }
    }
    return ($housesMax !== null) ? ($ret + $house) * 11 : ($ret + $house) * 10;
}

echo "Part One: " . houseNumber($input) . " Part Two: " . houseNumber($input, 50);

?>
