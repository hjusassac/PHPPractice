<?php

include_once 'model/placeManager.php';

$place_manager = new PlaceManager();

$places = $place_manager->getPlaces();
// $rating = $place_manager->giveStars($places['rating']);

if(isset($_POST['delete']) && $_POST['delete'] != '') {
    // delete
    $place_manager->deletePlaces($_POST['delete']);
    header("Refresh:0");
} else if(isset($_POST['edit']) && $_POST['edit'] != '') {
    echo 'edit id=' . $_POST['edit'];
}