<?php
class User extends Model_Base {

    public static function all(array $options = array()) {
        return array(new self(), new self());
    }

    public static function first() {
        return new self();
    }
}
?>