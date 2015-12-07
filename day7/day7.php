<?php
$input = file("input.txt", FILE_IGNORE_NEW_LINES);
$wires = array();

foreach($input as $inst) {
    list($in, $out) = explode(" -> ", $inst);
    $wires[$out] = $in;
}

function cableSignal($wire) {
    global $wires;

    if(preg_match('/^\d+$/', $wires[$wire])) return intval($wires[$wire]);
    if(preg_match('/^([a-z]+)$/', $wires[$wire])) return cableSignal($wires[$wire]);

    preg_match('/(([a-z0-9]+) )?([A-Z]+) ([a-z0-9]+)/', $wires[$wire], $split);
    $a = $split[2];
    $op = $split[3];
    $b = $split[4];

    if($a) {
        if(!preg_match('/^\d+$/', $a)) $a = cableSignal($a);
    }
    if(!preg_match('/^\d+$/', $b)) $b = cableSignal($b);

    $a = intval($a);
    $b = intval($b);

    if($op == "AND") $wires[$wire] = $a & $b;
    elseif($op == "OR") $wires[$wire] = $a | $b;
    elseif($op == "XOR") $wires[$wire] = $a ^ $b;
    elseif($op == "NOT") $wires[$wire] = ~ $b;
    elseif($op == "LSHIFT") $wires[$wire] = $a << $b;
    elseif($op == "RSHIFT") $wires[$wire] = $a >> $b;
    else die("operator failure.");

    return $wires[$wire];
}

// $wires["b"] = 46065; // <- Uncomment for solution to p2 of todays puzzle. Integer = Solution p1!

echo "Solution: " . cableSignal("a") . PHP_EOL;
?>
