<?php

function giveLink($map_provider, $map_link) {
    $map_provider = $map_provider == null ? $map_link:$map_provider;
    return '<a href="' . $map_link . '">' . $map_provider . '</a>';
}

function giveStars($num) {
    $num = (int) $num;
    $stars = ["★", "★★", "★★★", "★★★★", "★★★★★"];
    return $stars[$num-1];
}

function giveSelected($data) {
    $selected = array(
        'none'=>false,
        'google'=>false,
        'naver'=>false,
        'kakao'=>false
    );
    
    switch($data){
        case 'Google Maps':
            $selected['google'] = true;
            break;
        case 'Naver Map':
            $selected['naver'] = true;
            break;
        case 'Kakao Map':
            $selected['kakao'] = true;
            break;
        default:
            $selected['none'] = true;
            break;
    }
    
    return $selected;
}

function giveChecked($data) {
    $checked = array(
        '1'=>false,
        '2'=>false,
        '3'=>false,
        '4'=>false,
        '5'=>false
    );

    switch($data){
        case 1:
            $checked['1'] = true;
            break;
        case 2:
            $checked['2'] = true;
            break;
        case 3:
            $checked['3'] = true;
            break;
        case 4:
            $checked['4'] = true;
            break;
        case 5:
            $checked['5'] = true;
            break;
        default:
            break;
    }

    return $checked;
}

