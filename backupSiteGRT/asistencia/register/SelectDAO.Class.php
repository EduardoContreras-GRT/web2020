<?php

date_default_timezone_set("America/Mexico_City");
include_once './lib/connect/Proveedor.Class.php';

class SelectDAO {

    private $proveedor;

    public function __construct($proveedor = null) {
        if ($proveedor == null) {
            $this->proveedor = new Proveedor("mysql", "grahamross");
        } else {
            $this->proveedor = $proveedor;
        }
    }

    public function selectDAO($params, $proveedor = null, $paginacion = null, $procedures = false) {

        if ($params != "") {

            if ($proveedor == null) {
                $this->proveedor->connect();
            } else {
                $this->proveedor = $proveedor;
                // return json_encode($proveedor);
            }

//            print_r($params);
            if (!$procedures) {

                if (array_key_exists('fields', $params)) {

                    if (array_key_exists('tables', $params)) {
                        $sql = "SELECT " . $params["fields"] . " FROM " . $params["tables"];
                    } else {
                        $sql = "SELECT " . $params["fields"];
                    }

                    if (array_key_exists('conditions', $params)) {
                        if (trim($params["conditions"]) != "") {
                            $sql .= " WHERE " . $params["conditions"];
                        }
                    }

                    if (array_key_exists('groups', $params)) {
                        if (trim($params["groups"]) != "") {
                            $sql .= " GROUP BY " . $params["groups"];
                        }
                    }

                    if (array_key_exists('orders', $params)) {
                        if (trim($params["orders"]) != "") {
                            $sql .= " ORDER BY " . $params["orders"];
                        }
                    }
                    if ($paginacion != "" || $paginacion != null) {
                        $inicial = "";
                        if ($paginacion["paginacion"] == "true") {
                            if ($paginacion["pag"] > 0) {
                                $inicial = ($paginacion["pag"] - 1) * $paginacion["cantxPag"];
                            } else {
                                $inicial = 0;
                            }
                            $sql .= " LIMIT " . $inicial . "," . $paginacion["cantxPag"];
                        }
                    }
//                    echo "\n" . $sql . "\n";
                    $FielsName = explode(",", $params["fields"]);
                    $this->proveedor->execute($sql);

                    $json = "";
                    $cont = 0;
                    $jsondatos = "";
                    if (!$this->proveedor->error()) {
                        //return "ss".$this->proveedor->rows($this->proveedor->stmt). "ss";
                        if ($this->proveedor->rows($this->proveedor->stmt) > 0) {
                            //return "\n".$sql."\n";
                            $num_Field = mysqli_num_fields($this->proveedor->stmt);
                            $json .= "";
                            while ($result = $this->proveedor->fetch_array($this->proveedor->stmt, 0)) {
                                $jsonDetalle = "";
                                for ($index = 0; $index < $num_Field; $index++) {
                                    $fieldinfo = mysqli_fetch_field_direct($this->proveedor->stmt, $index);
                                    $jsonDetalle .= '"' . $fieldinfo->name . '":' . json_encode(utf8_encode($result[$fieldinfo->name])) . ',';
                                }
                                $cont++;
                                $jsondatos .= "\n" . '{' . substr($jsonDetalle, 0, -1) . '},';
                            }
                            $json .= substr($jsondatos, 0, -1) . "" . "\n";

                            $tmp = '{"status":"success",';
                            $tmp .= '"totalCount":"' . $cont . '",';
                            $tmp .= '"mnj":"Consulta exitosa",';
                            $tmp .= '"data":[';
                            $tmp .= $json;
                            $tmp .= "]";
                            $tmp .= "}";
                        } else {
                            $tmp = '{"status":"error",';
                            $tmp .= '"mnj":"Sin resultados",';
                            $tmp .= '"totalCount":"0"';
                            $tmp .= "}";
                        }
                    } else {
                        $tmp = '{"status":"error",';
                        $tmp .= '"mnj":' . json_encode(utf8_encode($this->proveedor->error()));
                        $tmp .= "}";
                    }

                    $this->proveedor->stmt = $this->proveedor->free_result($this->proveedor->stmt);
                    if ($proveedor == null) {
                        $this->proveedor->close();
                    }
                } else {
                    $tmp = '{"status":"error",';
                    $tmp .= '"mnj":"La consulta no contiene los parametros necesarios"';
                    $tmp .= "}";
                }
            } else {
                if (array_key_exists('procedure', $params)) {
                    $sql = "CALL " . $params["procedure"];

                    $this->proveedor->execute($sql);
                    $json = "";
                    $cont = 0;
                    $jsondatos = "";

                    if (!$this->proveedor->error()) {
                        if ($this->proveedor->rows($this->proveedor->stmt) > 0) {
                            $num_Field = mysqli_num_fields($this->proveedor->stmt);
                            $json .= "";
                            while ($result = $this->proveedor->fetch_array($this->proveedor->stmt, 0)) {
                                $jsonDetalle = "";
                                for ($index = 0; $index < $num_Field; $index++) {
                                    $fieldinfo = mysqli_fetch_field_direct($this->proveedor->stmt, $index);
                                    $jsonDetalle .= '"' . $fieldinfo->name . '":' . json_encode(utf8_encode($result[$fieldinfo->name])) . ',';
                                }
                                $cont++;
                                $jsondatos .= "\n" . '{' . substr($jsonDetalle, 0, -1) . '},';
                            }
                            $json .= substr($jsondatos, 0, -1) . "" . "\n";

                            $tmp = '{"status":"success",';
                            $tmp .= '"totalCount":"' . $cont . '",';
                            $tmp .= '"mnj":"Procedure",';
                            $tmp .= '"data":[';
                            $tmp .= $json;
                            $tmp .= "]";
                            $tmp .= "}";
                        } else {
                            $tmp = '{"status":"error",';
                            $tmp .= '"mnj":"Sin resultados",';
                            $tmp .= '"totalCount":"0"';
                            $tmp .= "}";
                        }
                    } else {
                        $tmp = '{"status":"error",';
                        $tmp .= '"mnj":' . json_encode(utf8_encode($this->proveedor->error()));
                        $tmp .= "}";
                    }
                }
            }
        } else {
            $tmp = '{"status":"error",';
            $tmp .= '"mnj":"La consulta no contiene los parametros"';
            $tmp .= "}";
        }
        return $tmp;
    }

    public function esFecha($fecha) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
            return true;
        }
        return false;
    }

    public function esFechaMysql($fecha) {
        if (preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $fecha)) {
            return true;
        }
        return false;
    }

    public function fechaMysql($fecha) {
        list($dia, $mes, $year) = explode("/", $fecha);
        return $year . "-" . $mes . "-" . $dia;
    }

    public function fechaNormal($fecha) {
        list($dia, $mes, $year) = explode("-", $fecha);
        return $year . "/" . $mes . "/" . $dia;
    }

}

//$SelectDAO = new SelectDAO();
//$params["fields"] = "*";
//$params["tables"] = "tblpersonal";
//$params["conditions"] = "";
//$params["groups"] = "";
//$params["orders"] = "";

//$rs = $SelectDAO->selectDAO($params);
//print_r($rs);

//paginacion
//$paginacion["paginacion"] = "true"; paginacion
//$paginacion["pag"]=1;//pagina actual
//$paginacion["cantxPag"]=10;   //registros por pagina a mostrar
