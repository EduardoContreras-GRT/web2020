<?php

include_once(dirname(__FILE__) . "/../connect/Proveedor.Class.php");

class Binnacle {

    protected $_proveedor;

    public function __construct($gestor = "mysql", $bd = "grahamross") {
        $this->_proveedor = new Proveedor('mysql', 'grahamross');
    }

    public function _conexion() {
        $this->_proveedor->connect();
    }

    public function saveBinnacle($params, $proveedor = null) {

        if ($proveedor == null) {
            $this->_conexion(null);
        } else if ($proveedor != null) {
            $this->_proveedor = $proveedor;
        }

        if ($params != "") {
           $sql = "INSERT INTO tblbitacoras(cveAccion, cveUsuario, descBitacora, fechaMovimiento, activo, fechaRegistro, fechaActualizacion)VALUES('" . $params["cveAccion"] . "','" . $params["cveUsuario"] . "','" . $params["descBitacora"] . "',CURDATE(),'S',now(),now())";
        }

        $this->_proveedor->execute($sql);
        if (!$this->_proveedor->error()) {
            $error = false;
        } else {
            $error = true;
        }
        if ($proveedor == null) {
            $this->_proveedor->close();
        }
        unset($sql);

        return $error;
    }

}
