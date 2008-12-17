<?php
$array = array(1, 2, 3, 4, false);
var_dump(in_array(0, $array));
var_dump(in_array("0", $array));
var_dump(in_array(null, $array));

$array = array(1, 2, 3, 4, false);
var_dump(in_array(0, $array, true));
var_dump(in_array("0", $array, true));
var_dump(in_array(null, $array, true));

$id = "0";
$array = array(1, 2, 3, 4, false, null);
var_dump(in_array((int) $id, $array, true));
?>