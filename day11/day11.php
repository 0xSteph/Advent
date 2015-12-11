<?php
$input = "cqjxjnds";

$threeLetters = threeLetterGenerator();
while (!pwValidation(++$input)) { }
echo "Part One: $input";
while(!pwValidation(++$input)) { }
echo " Part Two: $input";

function threeLetterGenerator() {
    $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
                 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x' ,'y', 'z',];
    $result = [];
    for ($i = 0; $i < count($alphabet) - 2; $i++) {
        $result[$alphabet[$i] . $alphabet[$i + 1] . $alphabet[$i + 2]] = true;
    }
    return $result;
}

function checkThreeLetters($input) {
    global $threeLetters;
    for ($i = 0; $i < strlen($input) - 2; $i++) {
        $substr = substr($input, $i, 3);
        if (isset($threeLetters[$substr])) {
            return true;
        }
    }
    return false;
}

function checkTwoPairs($input) {
    preg_match_all('/(\w)\1{1,}/', $input, $match);
    if (count($match[0]) >= 2 && $match[0][0] != $match[0][1]) {
        return true;
    }
    return false;
}

function checkInvalidChars($input) {
    return preg_match('/[iol]/', $input) === 1;
}

function pwValidation($input) {
    if (!checkThreeLetters($input)) {
        return false;
    }
    if (!checkTwoPairs($input)) {
        return false;
    }
    if (checkInvalidChars($input)) {
        return false;
    }
    return true;
}
?>
