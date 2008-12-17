<?php
error_reporting(E_ALL | E_STRICT);
ini_set('error_reporting', E_ALL ^ E_STRICT);
ini_set('display_errors', 'on');

class Pai {

    public function metodo(array $param) {
        print_r($param);
    }
}

class Filho extends Pai {

    public function metodo($name, array $param) {
        echo $name, "\n";
        print_r($param);
    }
}

$pai = new Pai();
$pai->metodo(array('a', 'b'));

$filho = new Filho();
$filho->metodo('teste', array('c', 'd'));
?>