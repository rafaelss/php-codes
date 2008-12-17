<?php
$globalsObject = new ArrayObject($GLOBALS);
$globalsObject["mykey"] = "mykey value";

echo "GLOBALS exists?\n";
var_dump($GLOBALS["mykey"]);

echo "mykey exists in globalsObject?\n";
var_dump($globalsObject["mykey"]);
?>