<?php
set_error_handler('error');

@trigger_error('foo');
print_r(error_get_last());

@trigger_error('bar');
print_r(error_get_last());

function error($number, $message, $file, $line) {
    if(error_reporting() === 0) {
        return false;
    }
}
?>