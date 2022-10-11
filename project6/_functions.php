<?php
    if(isset($_POST["placeName"]) && $_POST["placeName"]!="") $places = $_POST;
    else $places=[];
    // $places = isset($_POST["placeName"])&&$_POST["placeName"] ? $_POST:[];
    echo $_POST["placeName"];
    print_r($places);

    function createFile($file_path) {
        $file = fopen($file_path, "w");
        fclose($file);
    }

    function readFileContents($file_path) {
        clearstatcache();
        if(!file_exists($file_path)) createFile($file_path);
        else {
            $file = fopen($file_path, "r");
            $content = filesize($file_path)>0 ? fread($file, filesize($file_path)):"";
            fclose($file);
        }
        return json_decode($content);
    }
    
    function appendContent($places, $file_path) {
        $content = filesize($file_path)>0 ? readFileContents($file_path):[];
        array_push($content, $places);
        $file = fopen($file_path, "w");
        fwrite($file, json_encode($content, JSON_PRETTY_PRINT));
        fclose($file);
    }
    
