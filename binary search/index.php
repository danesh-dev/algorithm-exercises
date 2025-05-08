<?php

// get a sorted list from the user
$input = readline("Enter a sorted list of numbers (comma-separated): ");
// convert input to list of numbers
$list = array_map('intval', explode(',', $input));

// get the item to search for
$target = (int)readline("Enter the number to search for: ");

// save the number of comparisons
$comparisons = 0;

// perform binary search
$result = binarySearch($list, $target, $comparisons);

// show result
if ($result !== -1) {
    echo "Item found at index: $result\n";
} else {
    echo "Item not found.\n";
}
echo "Number of comparisons: $comparisons\n";



function binarySearch($arr, $target, &$comparisons) {
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {
        $comparisons++; 

        // divide the list in half
        $mid = (int)(($low + $high) / 2);

        if ($arr[$mid] == $target) {
            return $mid;
        } elseif ($arr[$mid] < $target) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }

    // in case of not found return -1
    return -1;
}
