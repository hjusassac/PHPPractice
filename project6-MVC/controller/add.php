<?php
$indexPath = 'index.php?action=list';

include_once 'model/placeManager.php';

$place_manager = new PlaceManager();

if(isset($_POST['add'])
    && isset($_POST['placeName']) && $_POST['placeName'] != ''
    && isset($_POST['memo']) && $_POST['memo'] != ''
) {
    $name = $_POST['placeName'];
    $map_provider = (isset($_POST['mapProvider']) && $_POST['mapProvider'] != '') ? $_POST['mapProvider']:null;
    $map_link = (isset($_POST['mapLink']) && $_POST['mapLink'] !='') ? $_POST['mapLink']:null;
    $memo = $_POST['memo'];
    $rating = isset($_POST['rating']) ? $_POST['rating']:null;

    // $timestamp = date("Y-m-d H:i:s");
    $place_manager->addPlaces($name, $map_provider, $map_link, $memo, $rating);
    header('Location: ' . $indexPath);
}