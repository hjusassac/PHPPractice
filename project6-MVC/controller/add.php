<?php

include_once 'model/placeManager.php';

$place_manager = new PlaceManager();

if(isset($_POST['add'])
    && isset($_POST['placeName']) && $_POST['placeName'] != ''
    && isset($_POST['memo']) && $_POST['memo'] != ''
) {
    $name = $_POST['placeName'];
    $map_provider = isset($_POST['map_provider']) ? $_POST['map_provider']:null;
    $map_link = isset($_POST['map_link']) ? $_POST['map_link']:null;
    $memo = $_POST['memo'];
    $rating = isset($_POST['rating']) ? $_POST['rating']:null;

    // $timestamp = date("Y-m-d H:i:s");
    $place_manager->addPlaces($name, $map_provider, $map_link, $memo, $rating);
}