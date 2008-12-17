<?php
class Results implements IteratorAggregate, ArrayAccess, Countable {

    private $stmt;
    
    private $results;

    public function __construct($stmt) {
        $this->stmt = $stmt;
    }
    
    public function getIterator() {
        echo 'teste';
        exit;
        $this->stmt->execute();
        $this->results = $this->stmt->fetchAll();
        return new ArrayObject($this->results);
    }

    public function current() {
        return current($this->results);
    }
    
    public function next() {
        return ($this->valid = next($this->results));
    }
    
    public function key() {
        return key($this->results);
    }
    
    public function valid() {
        return $this->valid;
    }
    
    public function rewind() {
        return ($this->valid = prev($this->results));
    }
    
    public function offsetExists($offset) {
        return isset($this->results[$offset]);
    }
    
    public function offsetGet($offset) {
        return $this->results[$offset];
    }
    
    public function offsetSet($offset, $value) {
        $this->results[$offset] = $value;
    }
    
    public function offsetUnset($offset) {
        unset($this->results[$offset]);
    }
    
    public function count() {
        return count($this->results);
    }
}
/*
    private $results;
    
    private $valid = false;
    
    public function __construct() {
        $this->results = new ArrayObject(array(1, 2, 3, 4, 5));
    }


    
    public function __toString() {
        return implode(';', $this->results->getArrayCopy());
    }
*/

$db = new PDO('mysql:host=localhost;dbname=cms', 'root', '');
$stmt = $db->prepare('SELECT * FROM products LIMIT 2');

$results = new Results($stmt);
print_r($results[0]);
#foreach($results as $product) {
#    print_r($product);
#}
?>