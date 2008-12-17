<?php
$fp = fsockopen("localhost", 81, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET /gremio_v1/default.aspx HTTP/1.1\r\n";
    $out .= "Host: localhost\r\n";
    $out .= "Connection: Close\r\n\r\n";

    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
exit;

$fp = fsockopen("www.gremio.net", 80, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET http://www.terra.com.br/capa/ HTTP/1.1\r\n";
    $out .= "Host: www.terra.com.br\r\n";
    $out .= "Connection: Close\r\n\r\n";

    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
?>