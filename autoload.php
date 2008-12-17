<?php
function __autoload($className) {
    require_once './user.php';
}

class MockUser {

    public function __construct() {
    }
    
    public static function first() {
    }
}

//$user = new MockUser();

$user = User::first();
?>