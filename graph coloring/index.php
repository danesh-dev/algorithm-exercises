<?php

// check if its safe to color vertix $v with color $c
function isSafe($vertex, $graph, $colors, $c, $V) {
    // check if connected vertic has the same color
    for ($i = 0; $i < $V; $i++) {
        if ($graph[$vertex][$i] == 1 && $colors[$i] == $c) {
            return false;
        }
    }
    return true;
}

function graphColoringUtil($graph, $m, $colors, $v, $V, &$solutions) {
    if ($v == $V) {
        // save the current valid coloring
        $solutions[] = $colors; 
        return;
    }

    for ($c = 1; $c <= $m; $c++) {
        if (isSafe($v, $graph, $colors, $c, $V)) {
            $colors[$v] = $c;
            graphColoringUtil($graph, $m, $colors, $v + 1, $V, $solutions);
            $colors[$v] = 0; // backtrack
        }
    }
}

function graphColoring($graph, $m) {
    $V = count($graph);
    $colors = array_fill(0, $V, 0);
    $solutions = [];

    graphColoringUtil($graph, $m, $colors, 0, $V, $solutions);

    if (empty($solutions)) {
        echo "No valid coloring found.\n";
        return;
    }

    echo "\n Total solutions: " . count($solutions) . "\n";
    foreach ($solutions as $index => $sol) {
        echo "\nSolution " . ($index + 1) . ":\n";
        foreach ($sol as $v => $color) {
            echo "  Vertex $v → Color $color\n";
        }
        echo "\n";
    }
}

// exmaple graph:
$graph = [
    [0, 1, 1, 1],
    [1, 0, 1, 0],
    [1, 1, 0, 1],
    [1, 0, 1, 0],
];

$m = (int) readline("number of colors: ");

graphColoring($graph, $m);
