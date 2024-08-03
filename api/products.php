<?php

include '../config.php';

header('Content-Type: application/json');

$rows = mysqli_query($conn, "SELECT * FROM products");
$currentRow = mysqli_fetch_assoc($rows);

$products = [];

while ($currentRow) {
    $products[] = $currentRow;
    $currentRow = mysqli_fetch_assoc($rows);
}

$json = json_encode($products);

echo $json;