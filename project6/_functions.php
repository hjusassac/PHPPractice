<?php
    function createFile($file_path) {
        $file = fopen($file_path, "w");
        fclose($file);
    }

    function readFileContents($file_path) {
        clearstatcache();
        if(!file_exists($file_path)) createFile($file_path);
        else {
            $file = fopen($file_path, "r"); // read the json format file
            $content = filesize($file_path)>0 ? fread($file, filesize($file_path)):"";
            fclose($file);
        }
        return json_decode($content, true); // return in array type
        // return $content;
    }

    function overWriteContent($file_path, $content) {
        $file = fopen($file_path, "w");
        fwrite($file, json_encode($content, JSON_PRETTY_PRINT)); // save in json format
        fclose($file);
    }
    
    function appendContent($places, $file_path) { // grab an array input
        $content = filesize($file_path)>0 ? readFileContents($file_path):[];
        array_push($content, $places);
        overWriteContent($file_path, $content);
    }

    function findAndExclude($item, $arrayAssociatives){
        // check if the values of the associative arrays in an array match with an input and if so, return an array excluding the associative array
        $selected = array_filter($arrayAssociatives, function ($value) use ($item){
            return $value["placeName"] != $item;
        });
        return array_values($selected); //return only the value of the array, not the key that was automatically created by array_filter()
    }

    function deleteItem($file_path, $selected) {
        // 1. read file and return an array = [[key1 => value, key2 => value, ...], [key1 => value, key2 => value, ...], ...]
        $array = readFileContents($file_path);

        // 2. find the matching item(associative array object) and return an array excluding the item
        $array = findAndExclude($selected, $array);

        // 3. rewrite the file with the result
        overWriteContent($file_path, $array);
    }

    function editItem($file_path, $selected) {
        // 1. find the file and return an array
        $array = readFileContents($file_path);
        $index=0;

        // 2. find the index of the matching item(associative array object) and 
        foreach($array as $item) {
            if($item['placeName'] == $selected["placeName"]) break;
            // $index1 = array_search($selected["placeName"], $item);
            // if($index1) break;
            $index ++;
        }

        // 3. return an array with updated data
        array_pop($selected); // delete "edit"=>true data
        array_splice($array, $index, 1, [$selected]);

        // 4. rewrite the file with the result
        overWriteContent($file_path, $array);
    }