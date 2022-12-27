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


// $actions = [];
// $dir = 'controller';
// $controllers = scandir($dir);
// foreach($controllers as $controller) {
//     $result = explode('.', $controller);
//     if($result[0]!='') array_push($actions, $result[0]);
// }

// if(array_search($action, $actions) !== false) {
//     include 'controller/' . $action . '.php';
//     require 'view/' . $action .'View.php';
// } else {
//     echo 'wrong url';
// }