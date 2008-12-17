<?php
$str = '';
$start = microtime(true);
for($i = 0; $i < 1000000; $i++) {
    $str .= sprintf('/%s/', $i);
}
echo sprintf('%.6f', microtime(true)-$start);
echo PHP_EOL, PHP_EOL;

$str = '';
$start = microtime(true);
for($i = 0; $i < 1000000; $i++) {
    $str .= '/' . $i . '/';
}
echo sprintf('%.6f', microtime(true)-$start);

echo PHP_EOL, PHP_EOL;

$str = '';
$start = microtime(true);
for($i = 0; $i < 1000000; $i++) {
    $str .= "/{$i}/";
}
echo sprintf('%.6f', microtime(true)-$start);
?>