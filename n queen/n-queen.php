<?php

// get input
$n = (int)readline("Enter N (number of queens): ");
$solution = findSolution($n);

// display solution
if ($solution) {
    echo "solution:\n";
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            echo ($solution[$i] === $j) ? 'Q' : '.';
        }
        echo "\n";
    }
} else {
    echo "No solution found.\n";
}


function findSolution($n) {
    $solution = [];
    $found = false;
    placeQueen([], 0, $n, $solution, $found);
    return $found ? $solution : null;
}

function placeQueen($queens, $row, $n, &$solution, &$found) {
    if ($found) return; // already found a solution, stop recursion

    if ($row === $n) {
        $solution = $queens;
        $found = true;
        return;
    }

    for ($col = 0; $col < $n; $col++) {
        if (isSafe($queens, $row, $col)) {
            $queens[$row] = $col;
            placeQueen($queens, $row + 1, $n, $solution, $found);
        }
    }
}

// check if its safe to put the queen in that row and column
function isSafe($queens, $r, $c) {
    foreach ($queens as $row => $col) {
        if ($col === $c || abs($col - $c) === abs($row - $r)) return false;
    }
    return true;
}
