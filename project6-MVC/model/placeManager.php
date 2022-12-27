<?php

include_once 'manager.php';

class PlaceManager extends Manager {
    public function getPlaces() {
        $db = Manager::connectDB();
        $places = $db->query('SELECT * FROM places');
        $places = $places->fetchAll();
        return $places;
    }

    public function getPlace($place_id) {
        $db = Manager::connectDB();
        $places = $db->prepare('SELECT * FROM places WHERE id = ?');
        $places->execute([$place_id]);
        $place = $places->fetch();
        return $place;
    }

    public function addPlaces($formData)
    {
        $db = Manager::connectDB();
        $add_places = $db->prepare('
            INSERT INTO places (name, map_provider, map_link, memo, rating)
            VALUE (?, ?, ?, ?, ?)
        ');
        $add_places->execute([
            $formData['name'],
            $formData['map_provider'],
            $formData['map_link'],
            $formData['memo'],
            $formData['rating'],
        ]);
    }

    public function deletePlaces($place_id)
    {
        $this->delete('places', $place_id);
    }

    public function editPlace($place_id, $formData)
    {
        $db = Manager::connectDB();
        $edit_places = $db->prepare(
            "UPDATE places SET " . "
            name = ?,
            map_provider = ?,
            map_link = ?,
            memo = ?,
            rating = ?
            " . "WHERE id = ?"
        );
        $edit_places->execute([
            $formData['name'],
            $formData['map_provider'],
            $formData['map_link'],
            $formData['memo'],
            $formData['rating'],
            $place_id
        ]);
    }
}