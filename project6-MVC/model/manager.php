<?php

class Manager {
    protected static $indexPath = 'http://localhost/git/PHPPractice/project6-MVC/index.php?action=list';

    protected static function connectDB() {
        return new PDO('mysql:host=localhost;dbname=fav_places;charset=utf8', 'root', '');
    }

    public static function giveStars($num) {
        $num = (int) $num;
        $stars = ["★", "★★", "★★★", "★★★★", "★★★★★"];
        return $stars[$num-1];
    }

    protected function delete($table_name, $id, $field_name = 'id') {
        $db = $this->connectDB();

        $delete = $db->prepare(
            "DELETE FROM " . $table_name . " WHERE " . $field_name . " = ?"
        );
        $delete->execute([$id]);

        header("Refresh:0");
    }
    
}

