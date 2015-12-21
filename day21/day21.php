<?php
$playerStats = ["life" => 100, "damage" => 0, "armor" => 0,];
$bossStats = ["life" => 104, "damage" => 8, "armor" => 1,];
$weaponList = [["name" => "Dagger", "cost" => 8, "damage" => 4, "armor" => 0],
               ["name" => "Shortsword", "cost" => 10, "damage" => 5, "armor" => 0],
               ["name" => "Warhammer", "cost" => 25, "damage" => 6, "armor" => 0],
               ["name" => "Longsword", "cost" => 40, "damage" => 7, "armor" => 0],
               ["name" => "Greataxe", "cost" => 74, "damage" => 8, "armor" => 0],];
$armorList = [["name" => "None", "cost" => 0, "damage" => 0, "armor" => 0],
              ["name" => "Leather", "cost" => 13, "damage" => 0, "armor" => 1],
              ["name" => "Chainmail", "cost" => 31, "damage" => 0, "armor" => 2],
              ["name" => "Splintmail", "cost" => 53, "damage" => 0, "armor" => 3],
              ["name" => "Bandedmail", "cost" => 75, "damage" => 0, "armor" => 4],
              ["name" => "Platemail", "cost" => 102, "damage" => 0, "armor" => 5],];
$ringList = [["name" => "NoDamnRing", "cost" => 0, "damage" => 0, "armor" => 0],
             ["name" => "NoDefRing", "cost" => 0, "damage" => 0, "armor" => 0],
             ["name" => "Damage +1", "cost" => 25, "damage" => 1, "armor" => 0],
             ["name" => "Damage +2", "cost" => 50, "damage" => 2, "armor" => 0],
             ["name" => "Damage +3", "cost" => 100, "damage" => 3, "armor" => 0],
             ["name" => "Defense +1", "cost" => 20, "damage" => 0, "armor" => 1],
             ["name" => "Defense +2", "cost" => 40, "damage" => 0, "armor" => 2],
             ["name" => "Defense +3", "cost" => 80, "damage" => 0, "armor" => 3],];

function bossFight(array $playerStats, array $bossStats) {
    while(true) {
        $hit = $playerStats["damage"] - $bossStats["armor"];
        $bossStats["life"] -= $hit > 1 ? $hit : 1;
        if($bossStats["life"] <= 0) {
            return "player";
        }
        $hit = $bossStats["damage"] - $playerStats["armor"];
        $playerStats["life"] -= $hit > 1 ? $hit : 1;
        if($playerStats["life"] <= 0) {
            return "boss";
        }
    }
}

$minCost = 10000;
$maxCost = 0;

foreach($weaponList as $weapon) {
    foreach($armorList as $armor) {
        $secRingList = $ringList;
        foreach($ringList as $key => $firstRing) {
            unset($secRingList[$key]);
            if(!empty($secRingList)) {
                foreach($secRingList as $secondRing) {
                    $cost = $weapon["cost"] + $armor["cost"] + $firstRing["cost"] + $secondRing["cost"];
                    if($cost > $minCost && $cost < $maxCost) {
                        continue;
                    }
                    $currentPlayer = $playerStats;
                    $currentPlayer["damage"] += $weapon["damage"] + $firstRing["damage"] + $secondRing["damage"];
                    $currentPlayer["armor"] += $armor["armor"] + $firstRing["armor"] + $secondRing["armor"];

                    $winner = bossFight($currentPlayer, $bossStats);
                    if($winner == "player") {
                        $minCost = min($minCost, $cost);
                    } else {
                        $maxCost = max($maxCost, $cost);
                    }
                }
            }
        }
    }
}

echo "Part One: " . $minCost . " Part Two: " . $maxCost . PHP_EOL;
?>
