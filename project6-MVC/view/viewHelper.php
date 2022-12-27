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

