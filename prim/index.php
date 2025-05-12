<?php

function primMST($graph) {
    $n = count($graph); // Number of vertices
    $nearest = array_fill(0, $n, 0);
    $distance = array_fill(0, $n, PHP_INT_MAX);
    $inMST = array_fill(0, $n, false);
    $mstEdges = [];

    // سtart from vertex 0
    $distance[0] = 0;

    for ($i = 0; $i < $n - 1; $i++) {
        // find the vertex with the minimum distance value, from the set of vertices not yet included in MST
        $min = PHP_INT_MAX;
        $vnear = -1;

        for ($j = 0; $j < $n; $j++) {
            if (!$inMST[$j] && $distance[$j] < $min) {
                $min = $distance[$j];
                $vnear = $j;
            }
        }

        // add the selected vertex to the MST Set
        $inMST[$vnear] = true;

        // if vnear is not the starting vertex, add the edge to the MST
        if ($nearest[$vnear] != $vnear) {
            $mstEdges[] = [$nearest[$vnear], $vnear, $graph[$vnear][$nearest[$vnear]]];
        }

        // update distance value and nearest index of the adjacent vertices of the picked vertex
        for ($j = 0; $j < $n; $j++) {
            if ($graph[$vnear][$j] && !$inMST[$j] && $graph[$vnear][$j] < $distance[$j]) {
                $distance[$j] = $graph[$vnear][$j];
                $nearest[$j] = $vnear;
            }
        }
    }

    return $mstEdges;
}

// Example usage:

$graph = [
    [0, 2, 0, 6, 0],
    [2, 0, 3, 8, 5],
    [0, 3, 0, 0, 7],
    [6, 8, 0, 0, 9],
    [0, 5, 7, 9, 0]
];

$mst = primMST($graph);

echo "Edges in the Minimum Spanning Tree:\n";
$totalWeight = 0;
foreach ($mst as $edge) {
    list($u, $v, $weight) = $edge;
    echo "Edge: $u - $v | Weight: $weight\n";
    $totalWeight += $weight;
}
echo "Total weight of MST: $totalWeight\n";
