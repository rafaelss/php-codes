<?php
class Project {

    public function __construct() {
        echo 'calling constructor', PHP_EOL;
    }

    public function __get($name) {
        echo 'getting: ', $name, PHP_EOL;
    }

    public function __set($name, $value) {
        echo 'setting: ', $name, ' with ', $value, PHP_EOL;
    }
}

$db = new PDO('mysql:host=mysql;dbname=w3intra_v2', 'root');
$stmt = $db->prepare('SELECT * FROM projects LIMIT 10');
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Project');
$stmt->execute();
$projects = $stmt->fetchAll();
?>