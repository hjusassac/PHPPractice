<?php

class Manager {
    protected static function connectDB() {
        return new PDO('mysql:host=localhost;dbname=fav_places;charset=utf8', 'root', '');
    }

    protected function delete($table_name, $id, $field_name = 'id') {
        $db = $this->connectDB();

        $delete = $db->prepare(
            "DELETE FROM " . $table_name . " WHERE " . $field_name . " = ?"
        );
        $delete->execute([$id]);
    }
    
}

