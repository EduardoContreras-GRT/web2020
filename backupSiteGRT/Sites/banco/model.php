<?php

@$action = $_POST["accion"];
@$txtId = $_POST["txtId"];
@$txtNombre = $_POST["txtNombre"];
@$txtPaterno = $_POST["txtPaterno"];
@$txtMaterno = $_POST["txtMaterno"];
@$txtNumCta = $_POST["txtNumCta"];
@$cmbActivo = $_POST["cmbActivo"];


if (isset($txtId) && $txtId != "") {
    $action = "Update";
}


switch ($action) {
    case "Save":

        echo $sql = "INSERT INTO Contactos(NumeroCta, Nombre, ApePat, ApeMat, activo ) "
        . "VALUES ('" . $txtNumCta . "','" . $txtNombre . "','" . $txtPaterno . "','" . $txtMaterno . "','" . $cmbActivo . "')";


        break;

    case "Update":
        echo $sql = "UPDATE Contactos SET activo ='" . $cmbActivo . "', "
        . "NumeroCta='" . $txtNumCta . "',"
        . "Nombre='" . $txtNombre . "',"
        . "ApePat='" . $txtPaterno . "',"
        . "ApeMat='" . $txtMaterno . "'"
        . "WHERE idContacto='" . $txtId . "'";

        break;

    case "Delete":
        echo $sql = "UPDATE Contactos SET activo ='N' WHERE idContacto='" . $txtId . "'";

        break;

    case "Select":
        echo $sql = "SELECT * FROM Contactos";

        break;
}