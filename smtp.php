<?php
$socket = fsockopen('localhost', 25);
if(is_resource($socket)) {
    echo "tem smtp\n";
}
else {
    echo "não tem\n";
}
?>