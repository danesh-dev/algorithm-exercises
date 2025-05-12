<?php

function dijkstra($graph, $start) {
    $n = count($graph);
    $dist = array_fill(0, $n, PHP_INT_MAX);
    $visited = array_fill(0, $n, false);
    $prev = array_fill(0, $n, null);

    $dist[$start] = 0;

    for ($i = 0; $i < $n - 1; $i++) {
        $min = PHP_INT_MAX;
        $u = -1;

        for ($j = 0; $j < $n; $j++) {
            if (!$visited[$j] && $dist[$j] < $min) {
                $min = $dist[$j];
                $u = $j;
            }
        }

        if ($u === -1) break;
        $visited[$u] = true;

        for ($v = 0; $v < $n; $v++) {
            if (!$visited[$v] && $graph[$u][$v] > 0) {
                $newDist = $dist[$u] + $graph[$u][$v];
                if ($newDist < $dist[$v]) {
                    $dist[$v] = $newDist;
                    $prev[$v] = $u;
                }
            }
        }
    }

    return [$dist, $prev];
}

function printResults($dist, $prev, $start) {
    echo "Node\tPath\tPrevious\n";
    foreach ($dist as $node => $cost) {
        $costStr = ($cost === PHP_INT_MAX) ? "∞" : $cost;
        $prevNode = $prev[$node] === null ? "-" : $prev[$node];
        echo "$node\t$costStr\t$prevNode\n";
    }
}

// Example graph (adjacency matrix)
$graph = [
    [0, 10, 0, 30, 100],
    [10, 0, 50, 0, 0],
    [0, 50, 0, 20, 10],
    [30, 0, 20, 0, 60],
    [100, 0, 10, 60, 0]
];

$start = 0;
[$distances, $previous] = dijkstra($graph, $start);
printResults($distances, $previous, $start);
