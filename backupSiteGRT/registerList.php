<?php

include_once './lib/connect/Proveedor.Class.php';
include_once './SelectDAO.Class.php';

class registerList {

    public function __construct() {
        ;
    }

    public function getAllRegister() {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "*";
        $params["tables"] = "tblparticipantes";
        $params["conditions"] = "activo='S'";
//        $params["groups"] = "";
        $params["orders"] = " fechaRegistro";
        return $SelectDAO->selectDAO($params);
    }
    public function getAllCheckIn() {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "*";
        $params["tables"] = "tblparticipantes";
        $params["conditions"] = "activo='A'";
//        $params["groups"] = "";
        $params["orders"] = " paterno";
        return $SelectDAO->selectDAO($params);
    }

    public function getRegister($idParticipante) {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "*";
        $params["tables"] = "tblparticipantes";
        $params["conditions"] = "idParticipante='" . $idParticipante . "'";
//        $params["groups"] = "";
        $params["orders"] = "";
        return $SelectDAO->selectDAO($params);
    }

}

@$accion = $_POST["accion"];
@$idParticipante = $_POST["idParticipante"];

switch ($accion) {
    case "getAllRegister":
        $registerList = new registerList();
        echo $registerList->getAllRegister();

        break;
    case "getRegister":
        $registerList = new registerList();
        echo $registerList->getRegister($idParticipante);
        break;
    case "getAllAsist":
        $registerList = new registerList();
        echo $registerList->getAllCheckIn();
        break;
    case "setAssistence":
        $cnn = mysqli_connect("localhost", "grtmx_simposio", "12qwasZX_", "grtmx_simposio");
        $query = "UPDATE tblparticipantes SET activo='A' WHERE idParticipante='" . $idParticipante . "';";
        $result = mysqli_query($cnn, $query);
        if (!mysqli_error($cnn)) {
            $registerList = new registerList();
            echo $registerList->getRegister($idParticipante);
        }
        break;
}


