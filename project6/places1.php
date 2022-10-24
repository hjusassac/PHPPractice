<?php
    include "_paths.php";

    // include "_variables.php";
    if(isset($_POST["placeName"]) && $_POST["placeName"]!="") $places = $_POST;
    else $places=[];

    include "_functions.php";

    if(isset($_POST["delete"]) && $_POST["delete"]) {
        deleteItem($file_path, $_POST["placeId"]);
        // echo "deleted";
    }else if(isset($_POST["edit"]) && $_POST["edit"]) {
        editItem($file_path, $_POST);
        // echo "edit";
    }else if($places!=[]) {
        // when there's form input, process the input and store in the file
        // array_splice($places, 1, 1);
        appendContent($places, $file_path);
        // echo "added";
    }
    // and then read the file contents to display below
    $saved = readFileContents($file_path);
    print_r(json_encode($saved));
    
