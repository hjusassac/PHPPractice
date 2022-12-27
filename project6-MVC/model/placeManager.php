<?php

include_once 'manager.php';

class PlaceManager extends Manager {
    public function getPlaces() {
        $db = Manager::connectDB();
        $places = $db->query('SELECT * FROM places');
        $places = $places->fetchAll();
        return $places;
    }

    public function addPlaces($name, $map_provider, $map_link, $memo, $rating)
    {
        $db = Manager::connectDB();
        $add_places = $db->prepare('
            INSERT INTO places (name, map_provider, map_link, memo, rating)
            VALUE (?, ?, ?, ?, ?)
        ');
        $add_places->execute([$name, $map_provider, $map_link, $memo, $rating]);
        // header('Location: ' . Manager::$indexPath);
    }

    public function deletePlaces($place_id)
    {
        $this->delete('places', $place_id);
    }

}