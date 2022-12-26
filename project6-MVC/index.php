<?php

if(isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list';
}

$actions = [];
$dir = 'controller';
$controllers = scandir($dir);
foreach($controllers as $controller) {
    $result = explode('.', $controller);
    if($result[0]!='') array_push($actions, $result[0]);
}

if(array_search($action, $actions) !== false) {
    include 'controller/' . $action . '.php';
    require 'view/' . $action .'View.php';
    // require is identical to include except upon failure it will also produce a fatal E_COMPILE_ERROR level error. 
    // In other words, it will halt the script whereas include only emits a warning (E_WARNING) which allows the script to continue.
} else {
    echo 'wrong url';
}

// switch ($action) {
//     case 
// }
