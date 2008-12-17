<?php
$name = "index";
$pathinfo = pathinfo($name);
if(empty($pathinfo["extension"])) {
    $pathinfo["extension"] = "tpl";
}
print_r($pathinfo);
?>