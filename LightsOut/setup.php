<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$rows = 0;
$columns = 0;
// Use GET requests
if (isset($_GET["rows"]) && isset($_GET["columns"])) {
    $rows = $_GET["rows"];
    $columns = $_GET["columns"];
}
// Check if board has less than 5 boxes
if ($rows*$columns < 5) {
    $array = array(); //array where coordinates are represented as sequential IDs
    for($i=0; $i<$rows; $i++) {
        for($j=0; $j<$columns; $j++) {
            array_push($array, ($i*$columns)+$j);
        }
    }
    // Return JSON object with list of all positions
    header("Content-type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}
else {
    $array = array(); //array where coordinates are represented as sequential IDs
    $i = 0;
    while($i < 5) {
        $random_index = rand(0, ($rows*$columns)-1);
        if (!in_array($random_index, $array)) {
            array_push($array, $random_index);
            $i++;
        }
    }
    // Randomly select 5 starting positions where lights will be on at the start of the game, return JSON object with list of 5 positions
    header("Content-type: application/json");
    echo json_encode($array, JSON_PRETTY_PRINT);
}