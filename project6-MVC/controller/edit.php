<?php

include_once '_paths.php';
include_once 'model/placeManager.php';

$place_manager = new PlaceManager();

$id = $_GET['id'];

$place = $place_manager->getPlace($id);


if(isset($_POST['edit']) && $_POST['edit'] == $id
    && isset($_POST['placeName']) && $_POST['placeName'] != ''
    && isset($_POST['memo']) && $_POST['memo'] != ''
) {
    $name_e = $_POST['placeName'];
    $map_provider_e = (isset($_POST['mapProvider']) && $_POST['mapProvider'] != '') ? $_POST['mapProvider']:null;
    $map_link_e = (isset($_POST['mapLink']) && $_POST['mapLink'] !='') ? $_POST['mapLink']:null;
    $memo_e = $_POST['memo'];
    $rating_e = isset($_POST['rating']) ? $_POST['rating']:null;

    $formData = array(
        'name'=>$name_e,
        'map_provider'=>$map_provider_e,
        'map_link'=>$map_link_e,
        'memo'=>$memo_e,
        'rating'=>$rating_e
    );

    $place_manager->editPlace($id, $formData);

    header('Location: ' . $indexPath);
}