<?php

function randomStatus() {
    $status = ['active', 'inactive'];
    $status = $status[array_rand($status)];

    return $status;
}

function randomCode() {
    $codes = ['S-501', 'S-502', 'P-501', 'P-502', 'JP-501', 'JP-502', 'TS-501', 'TS-502', 'M-501', 'M-502', 'T-501', 'T-502'];
    $codes = $codes[array_rand($codes)];

    return $codes;
}

function randomModel() {
    $models = ['A-101', 'A-102', 'B-101', 'B-102', 'C-101', 'C-102', 'D-101', 'D-102'];
    $models = $models[array_rand($models)];

    return $models;
}

function randomColor() {
    $colors = ['red', 'greeen', 'blue', 'black', 'orange', 'white', 'off white'];
    $colors = $colors[array_rand($colors)];

    return $colors;
}

function randomSize() {
    $sizes = ['L', 'M', 'XL', 'XXL', 'S', '1.5mm', '2.5mm', '1.1mm', '1.8mm', '28', '32', '34', '36'];
    $sizes = $sizes[array_rand($sizes)];

    return $sizes;
}

function randomWarrantyDuration() {
    $warranty_duration = ['1 month', '2 month\'s', '3 month\'s', '4 month\'s', '6 month\'s', '1 year', '2 Year\'s'];
    $warranty_duration = $warranty_duration[array_rand($warranty_duration)];

    return $warranty_duration;
}

function randomProductAvailable() {
    $product_avaliable = ['in stock', 'out of stock', 'stock limit'];
    $product_avaliable = $product_avaliable[array_rand($product_avaliable)];

    return $product_avaliable;
}
