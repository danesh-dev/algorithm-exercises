<?php

function hanoi($n, $source, $helper, $destination, &$moves) {
    if ($n == 1) {
        $moves[] = "Move disk 1 from $source to $destination";
        return;
    }

    // move n-1 from source to helper
    hanoi($n - 1, $source, $destination, $helper, $moves);

    // move remaining disk from source to destination
    $moves[] = "Move disk $n from $source to $destination";

    // move n-1 from helper to destination
    hanoi($n - 1, $helper, $source, $destination, $moves);
}

// get input from user
$n = (int)readline("Enter number of disks: ");
$moves = [];

hanoi($n, 'A', 'B', 'C', $moves);

// Output moves
foreach ($moves as $step => $move) {
    echo "Step " . ($step + 1) . ": $move\n";
}

echo "Total moves: " . count($moves) . "\n";
