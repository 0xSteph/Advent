<?php
$input = str_replace('lose ', '-', file_get_contents('input.txt'));
preg_match_all('/([A-Za-z]+) [^\-\d]*?(-?\d+).*? ([A-Za-z]+)\./', $input, $matches);
$people = array_unique($matches[1]);
foreach($matches[0] as $i => $match) {
	$happiness[$matches[1][$i]][$matches[3][$i]] = $matches[2][$i];
}
foreach($people as $m) {
	foreach($people as $n) {
		if($m != $n) {
			$Happiness[$m][$n] = $happiness[$m][$n] + $happiness[$n][$m];
		}
	}
}
seatingChart($Happiness, $people, $seatings, $plusMe);

function seatingChart(&$Happiness, &$people, &$seatings, &$plusMe, $seating = "") {
	foreach($people as $m) {
		$newSeating = "$seating:$m";
		$parts = explode(":", $newSeating);
		if(count($parts) < 2) continue;
		$newPeople = array_diff($people, $parts);
		if(count($newPeople)) {
			seatingChart($Happiness, $newPeople, $seatings, $plusMe, $newSeating);
		} else {
			for($i = 1, $j = 0, $l = count($parts) - 1; $i < $l; $i++) {
				$j += $Happiness[$parts[$i]][$parts[$i+1]];
				$seatings[$newSeating] = $j;
				$plusMe[$newSeating] = $j + $Happiness[$parts[1]][$parts[$l]];
			}
		}
	}
}

echo max($seatings) . " " . max($plusMe);

?>
