<?php
echo serialize(array());

echo PHP_EOL, PHP_EOL;

$array = array();
echo serialize($array);

echo PHP_EOL, PHP_EOL;

$a = array(serialize($array) => 'aaaa');
print_r($a);

echo PHP_EOL, PHP_EOL;

print_r($a[serialize($array)]);
?>