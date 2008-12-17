<?php
class Db_Table {

    public function __construct($name) {
    }
    
    public function __call($type, $arguments) {
    }
}

abstract class Migration {

    function createTable($name, $columnsClosure) {
        $table = new Db_Table($name);
        $columnsClosure($table);
    }
}

class CreateUser extends Migration {

    public function up() {
        $this->createTable('users', function($t) {
            $t->string('name');
            $t->string('email');
            $t->boolean('is_active');
        });
    }

    public function down() {
        $this->dropTable('users');
    }
}

$m = new CreateUser();

echo "'users' table created\n";
$m->up();

echo "'users' table dropped\n";
$m->down();
?>