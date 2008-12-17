<?php
$count = 100000;

$start = microtime(true);
$fp = fopen('a.log', 'ab');
for($i = 0; $i < $count; $i++) {
    fwrite($fp, $i . PHP_EOL);
}
fclose($fp);
echo sprintf('%.6f', microtime(true)-$start);

echo PHP_EOL, PHP_EOL;

$start = microtime(true);
for($i = 0; $i < $count; $i++) {
    file_put_contents('b.log', $i . PHP_EOL, FILE_APPEND);
}
echo sprintf('%.6f', microtime(true)-$start);
?>