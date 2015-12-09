<?php
$input = explode("\n", str_replace([" to ", " = "], ":", file_get_contents("input.txt")));
$valid = [];
foreach ($input as $path) {
    $param = explode(":", $path);
    $valid[$param[0]][$param[1]] = $valid[$param[1]][$param[0]] = $param[2];
}

$locations = array_keys($valid);
findPath($valid, $locations, $paths);

function findPath(&$valid, &$locations, &$paths, $path = "") {
    foreach($locations as $location) {
        if (isset($paths[$path])) unset($paths[$path]);
        $newPath = "$path:$location";
        $parts = explode(":", $newPath);
        $size = count($parts) ;

        if ($size > 2 && !isset($valid[$parts[$size-2]][$parts[$size-1]])) continue;
        $paths[$newPath] = 0;
        $newLocations = array_diff($locations, $parts);

        if (count($newLocations)) findPath($valid, $newLocations, $paths, $newPath);
    }
}

$minPath = $maxPath = 0;
foreach($paths as $path => $val) {
    $parts = explode(":", $path);
    $partCount = count($parts) - 1;
    $length = 0;

    for ($i = 1; $i < $partCount; $i++) {
        if (isset($valid[$parts[$i]][$parts[$i+1]])) $length += $valid[$parts[$i]][$parts[$i+1]];
        elseif (isset($valid[$parts[$i+1]][$parts[$i]])) $length += $valid[$parts[$i+1]][$parts[$i]];
    }

    if ($minPath == 0 || $length < $minPath) $minPath = $length;
    if ($length > $maxPath) $maxPath = $length;
}

echo "Part One: " . $minPath . " Part Two: " . $maxPath;
?>
