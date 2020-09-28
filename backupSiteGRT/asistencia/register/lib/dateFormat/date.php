<?php

function esFecha($fecha) {
    if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
        return true;
    }
    return false;
}

function esFechaMysql($fecha) {
    if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha)) {
        return true;
    }
    return false;
}

function fechaMysql($fecha) {
    list($dia, $mes, $year) = explode("/", $fecha);
    return $year . "-" . $mes . "-" . $dia;
}

function fechaNormal($fecha) {
    list($dia, $mes, $year) = explode("/", $fecha);
    return $year . "-" . $mes . "-" . $dia;
}
?>