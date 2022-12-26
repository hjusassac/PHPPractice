<?php

include_once 'model/placeManager.php';

$place_manager = new PlaceManager();

$places = $place_manager->getPlaces();
// $rating = $place_manager->giveStars($places['rating']);
