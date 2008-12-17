<?php
$var1 = "var 1";
$var2 = "var 2";
$var3 = "var 3";
$var4 = "var 4";
$var5 = "var 5";
$var6 = "var 6";
$var7 = "var 7";
$var8 = "var 8";
$var9 = "var 9";

$start = microtime(true);

$contents = null;
$lines = file("index.tpl");
foreach($lines as $index => $line) {
    if((strpos($line, '<?') !== false && strpos($line, '?>') === false) || strpos($line, '<?php') !== false) {
        throw new Exception("Syntax error in line " . ($index+1));
    }

    $line = preg_replace('/<\?[^=]/', '<?php ', $line);
    $line = preg_replace('/<\?=/', '<?php echo', $line);

    $contents .= $line;
}

file_put_contents("index.tpl.php", $contents);
echo sprintf("processed in %.6f", (microtime(true) - $start));
include("index.tpl.php");


?>