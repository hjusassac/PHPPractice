<?php
include 'controller/placeController.php';

$action = isset($_GET['action']) ? $_GET['action']:'list';

try{
    switch ($action) {
        case 'list':
            listPlaces();
            break;
        case 'add':
            addPlaces();
            break;
        case 'edit':
            editPlaces();
            break;
        default:
            listPlaces();
            break;
    }    
} catch(Error $e){
    $EM = $e->getMessage() != '' ? $e->getMessage():'UNKNOWN ERROR';
    displayError($EM);
}