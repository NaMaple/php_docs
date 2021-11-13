<?php
/**
 * 抛出异常
 */

function getException(){
    if (1<2) {
        throw new Exception('throw exception');
    }
}

try {
    getException();
} catch (Exception $exception) {
    echo $exception->getMessage();
    var_dump($exception);
}

