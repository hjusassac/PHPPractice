<?php
// include '_paths.php';
include_once 'model/placeManager.php';

function listPlaces() {
    include_once '_paths.php';
    $place_manager = new PlaceManager();

    $places = $place_manager->getPlaces();

    if(isset($_POST['delete']) && $_POST['delete'] != '') {
        $place_manager->deletePlaces($_POST['delete']);
        header("Refresh:0");
    }

    require 'view/listView.php';
}

function addPlaces() {
    include_once '_paths.php';
    $place_manager = new PlaceManager();

    if(isset($_POST['add'])
        && isset($_POST['placeName']) && $_POST['placeName'] != ''
        && isset($_POST['memo']) && $_POST['memo'] != ''
    ) {
        $formData = array(
            'name' => $_POST['placeName'],
            'map_provider' => (isset($_POST['mapProvider']) && $_POST['mapProvider'] != '') ? $_POST['mapProvider']:null,
            'map_link' => (isset($_POST['mapLink']) && $_POST['mapLink'] !='') ? $_POST['mapLink']:null,
            'memo' => $_POST['memo'],
            'rating' => isset($_POST['rating']) ? $_POST['rating']:null
        );

        $place_manager->addPlaces($formData);
        header('Location: ' . $indexPath);
    }

    require 'view/addView.php';
}

function editPlaces() {
    include_once '_paths.php';
    $place_manager = new PlaceManager();

    $id = $_GET['id'];

    $place = $place_manager->getPlace($id);
    if(empty($place)) {
        throw new Error("Wrong Access: You're trying to edit a deleted record.");
    }

    if(isset($_POST['edit']) && $_POST['edit'] == $id
        && isset($_POST['placeName']) && $_POST['placeName'] != ''
        && isset($_POST['memo']) && $_POST['memo'] != ''
    ) {
        $formData = array(
            'name' => $_POST['placeName'],
            'map_provider' => (isset($_POST['mapProvider']) && $_POST['mapProvider'] != '') ? $_POST['mapProvider']:null,
            'map_link' => (isset($_POST['mapLink']) && $_POST['mapLink'] !='') ? $_POST['mapLink']:null,
            'memo' => $_POST['memo'],
            'rating' => isset($_POST['rating']) ? $_POST['rating']:null
        );

        $place_manager->editPlace($id, $formData);

        header('Location: ' . $indexPath);
    }

    require 'view/editView.php';
}

function displayError($errorMessage) {
    include 'controller/_paths.php';
    require 'view/errorView.php';
}