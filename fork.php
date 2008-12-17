<?php
//$pid = pcntl_fork();
//if ( $pid ) {
//    exit(0);
//}

// cria uma nova seзгo, desligando-se do processo shell original
//posix_setsid();

// se as constantes STD(IN,OUT,ERR) precisam tornar-se indisponveis, Г© aqui que se fecha as
// mesmas

while(true) {
    error_log("heartbeat \n", 3, "test.log");
    sleep(10);
}
?>