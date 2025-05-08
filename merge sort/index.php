<?php

function mergeSort($array) {
    $length = count($array);
    if ($length <= 1) {
        return $array; // base case: already sorted
    }

    //split list to halfes
    $mid = (int)($length / 2);
    $left = array_slice($array, 0, $mid);
    $right = array_slice($array, $mid);       

    //sort halfes
    $leftSorted = mergeSort($left);  
    $rightSorted = mergeSort($right);   

    return merge($leftSorted, $rightSorted);  
}

function merge($left, $right) {
    $result = [];
    $i = $j = 0;

    while ($i < count($left) && $j < count($right)) {
        if ($left[$i] <= $right[$j]) {
            $result[] = $left[$i++];
        } else {
            $result[] = $right[$j++];
        }
    }

    // append remaining items (if exist)
    while ($i < count($left)) {
        $result[] = $left[$i++];
    }

    while ($j < count($right)) {
        $result[] = $right[$j++];
    }

    return $result;
}


// get a sorted list from the user
$input = readline("Enter a list of numbers (comma-separated) for merge sort: ");
// convert input to list of numbers
$list = array_map('intval', explode(',', $input));

$sorted = mergeSort($list);
print_r($sorted);