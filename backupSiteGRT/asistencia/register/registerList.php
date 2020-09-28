<?php

include_once './lib/connect/Proveedor.Class.php';
include_once './SelectDAO.Class.php';

require_once "./phpqrcode/qrlib.php";

date_default_timezone_set('UTC');
$timestamp = date('dmhms');

class registerList {

    public function __construct() {
        ;
    }

    public function getAllRegister() {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "EP.Id, EP.QrEnviado, EP.FechaEnvioQr, EP.IdEvento, EP.IdParticipante, P.NombreCompleto, P.Nombre, P.ApellidoPaterno, P.ApellidoMaterno, P.Cuenta, P.Cargo, P.Correo, E.Evento, E.Sede, EP.urlQr, EP.Asistencia, EP.FechaAsistencia";
        $params["tables"] = "EventosParticipantes EP, Participante P, Eventos E";
        $params["conditions"] = "EP.IdEvento = E.Id AND EP.IdParticipante=P.Id AND EP.IdEvento=1";
//        $params["groups"] = "";
        $params["orders"] = "";
        return $SelectDAO->selectDAO($params);
    }

    public function getAllCheckIn() {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "*";
        $params["tables"] = "EventosParticipantes EP, Participante P, Eventos E";
        $params["conditions"] = "EP.IdEvento = E.Id AND EP.IdParticipante=P.Id AND EP.Asistencia='S' AND EP.IdEvento=1";
//        $params["groups"] = "";
        $params["orders"] = "";
        return $SelectDAO->selectDAO($params);
    }

    public function getRegister($idParticipante) {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "EP.Id, EP.QrEnviado, EP.FechaEnvioQr, EP.IdEvento, EP.IdParticipante, P.NombreCompleto, P.Nombre, P.ApellidoPaterno, P.ApellidoMaterno, P.Cuenta, P.Cargo, P.Correo, E.Evento, E.Sede, EP.urlQr, EP.Asistencia, EP.FechaAsistencia";
        $params["tables"] = "EventosParticipantes EP, Participante P, Eventos E";
        $params["conditions"] = "EP.IdEvento = E.Id AND EP.IdParticipante=P.Id AND EP.IdParticipante='" . $idParticipante . "'";
//        $params["groups"] = "";
        $params["orders"] = "";
//        var_dump($params);

        return $SelectDAO->selectDAO($params);
    }

    public function getAllInSede($Sede) {
        $SelectDAO = new SelectDAO();
        $params["fields"] = "EP.Id, EP.QrEnviado, EP.FechaEnvioQr, EP.IdEvento, EP.IdParticipante, P.NombreCompleto, P.Nombre, P.ApellidoPaterno, P.ApellidoMaterno, P.Cuenta, P.Cargo, P.Correo, E.Evento, E.Sede, EP.urlQr, EP.Asistencia, EP.FechaAsistencia";
        $params["tables"] = "EventosParticipantes EP, Participante P, Eventos E";
        $params["conditions"] = "EP.IdEvento = E.Id AND EP.IdParticipante=P.Id AND EP.IdEvento='" . $Sede . "'";
//        $params["groups"] = "";
        $params["orders"] = "";
//        var_dump($params);

        return $SelectDAO->selectDAO($params);
    }

}

@$accion = $_POST["accion"];
@$idParticipante = $_POST["idParticipante"];
@$Sede = $_POST["Sede"];
@$Id = $_POST["Id"];
@$EmailCustom = $_POST["EmailCustom"];

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
        
        $cnn = mysqli_connect("localhost", "grtmx_registro", "_12qwasZX_", "grtmx_registro");
        $query = "UPDATE EventosParticipantes SET Asistencia='S', FechaAsistencia=now() WHERE IdParticipante='" . $idParticipante . "';";
        $result = mysqli_query($cnn, $query);
        if (!mysqli_error($cnn)) {
            $registerList = new registerList();
            echo $registerList->getRegister($idParticipante);
        }
        break;
    case "setQr":
        $cnn = mysqli_connect("localhost", "grtmx_registro", "_12qwasZX_", "grtmx_registro");
        $query = "UPDATE EventosParticipantes SET QrEnviado='S', FechaEnvioQr=now() WHERE IdParticipante='" . $idParticipante . "';";
        $result = mysqli_query($cnn, $query);
        if (!mysqli_error($cnn)) {
            $registerList = new registerList();
            echo $registerList->getRegister($idParticipante);
        }
        break;
    case "setGracias":
        $cnn = mysqli_connect("localhost", "grtmx_registro", "_12qwasZX_", "grtmx_registro");
        $query = "UPDATE EventosParticipantes SET Gracias='S', FechaGracias=now() WHERE IdParticipante='" . $idParticipante . "';";
        $result = mysqli_query($cnn, $query);
        if (!mysqli_error($cnn)) {
            $registerList = new registerList();
            echo $registerList->getRegister($idParticipante);
        }
        break;
    case "getAllInSede":
        $registerList = new registerList();
        echo $registerList->getAllInSede($Sede);
        break;

    case "sendQr":

        $registerList = new registerList();
        $json = $registerList->getRegister($Id);

        $arr = json_decode($json, true);

//        var_dump($arr);

        if ($arr["status"] === "success") {

//            var_dump($arr["data"][0]["Id"]);
//            var_dump($arr["data"][0]["Nombre"]);
//            var_dump($arr["data"][0]["NombreCompleto"]);
//            var_dump($arr["data"][0]["Correo"]);
//            var_dump($arr["data"][0]["Cuenta"]);

            $dir = 'tempqr/';
            if (!file_exists($dir)) {
                mkdir($dir);
            }

            $imageName = $timestamp . "Qr-" . $Id . "." . "png";
            $filename = $dir . $imageName;

            $destinatario = $arr["data"][0]["Correo"];
            $de = $arr["data"][0]["Correo"];

            $cabeceras = "MIME-Version: 1.0\r\n";
            $cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
            $cabeceras .= utf8_decode("From: {$arr["data"][0]["NombreCompleto"]}<{$de}>\r\n");
            $cabeceras .= "Reply-To: {$de}\r\n";


//Parametros de Condiguración
            $tamanio = 8; //Tamaño de Pixel
            $level = 'Q'; //Precisión Baja
            $framSize = 2; //Tamaño en blanco
            $contenido = "https://grt.mx/asistencia/validate.php?idParticipante=" . $Id;
//echo "<br>url:" . $contenido . " <br>";
//Enviamos los parametros a la Función para generar código QR 
            QRcode::png($contenido, $filename, $level, $tamanio, $framSize);

            $from2 = 'MIME-Version: 1.0' . "\r\n";
            $from2 .= "Content-type: text/html; charset=iso-8859-1 \r\n";
            $from2 .= "From: " . utf8_decode("Seminario GrahamRoss Training") . " <" . utf8_decode("seminario@grt.mx") . ">\r\n";

            $mensaje = getMessage($Id, $imageName);

            if ($mensaje !== "") {

                try {
                    $destinatarios = "neri.lozano@grt.mx, nancy.gallegos@grt.mx";

                    //Update Qr Envido
                    $mailSender = mail($destinatarios, "Registro Seminario GrahamRoss Training", utf8_decode($mensaje), $from2);

                    if ($mailSender) {
                        $cnn = mysqli_connect("localhost", "grtmx_registro", "_12qwasZX_", "grtmx_registro");
                        $query = "UPDATE EventosParticipantes SET QrEnviado='S', FechaEnvioQr=now(), urlQr='" . $imageName . "' WHERE Id='" . $Id . "'";
                        $result = mysqli_query($cnn, $query);
                        if (!mysqli_error($cnn)) {
                            echo '{"status": "Ok"}';
                        } else {
                            echo '{"status": "failUpdate"}';
                        }
                    } else {
                        echo '{"status": "errorMail"}';
                    }
                } catch (Exception $ex) {
                    echo '{"status": "fail2"}';
                    echo $ex->getTrace();
                }
            } else {
                echo '{"status": "fail3"}';
            }
        } else {
            echo '{"status": "fail4"}';
        }
        break;

    case "sendCustomQr":

        $registerList = new registerList();
        $json = $registerList->getRegister($Id);

        $arr = json_decode($json, true);

//        var_dump($arr);

        if ($arr["status"] === "success") {

//            var_dump($arr["data"][0]["Id"]);
//            var_dump($arr["data"][0]["Nombre"]);
//            var_dump($arr["data"][0]["NombreCompleto"]);
//            var_dump($arr["data"][0]["Correo"]);
//            var_dump($arr["data"][0]["Cuenta"]);

            $dir = 'tempqr/';
            if (!file_exists($dir)) {
                mkdir($dir);
            }

            $imageName = $timestamp . "Qr-" . $Id . "." . "png";
            $filename = $dir . $imageName;

            $destinatario = $EmailCustom;
            $de = $EmailCustom;

            $cabeceras = "MIME-Version: 1.0\r\n";
            $cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
            $cabeceras .= utf8_decode("From: {$EmailCustom}<{$de}>\r\n");
            $cabeceras .= "Reply-To: {$de}\r\n";


//Parametros de Condiguración
            $tamanio = 8; //Tamaño de Pixel
            $level = 'Q'; //Precisión Baja
            $framSize = 2; //Tamaño en blanco
            $contenido = "https://grt.mx/asistencia/validate.php?idParticipante=" . $Id;
//echo "<br>url:" . $contenido . " <br>";
//Enviamos los parametros a la Función para generar código QR 
            QRcode::png($contenido, $filename, $level, $tamanio, $framSize);

            $from2 = 'MIME-Version: 1.0' . "\r\n";
            $from2 .= "Content-type: text/html; charset=iso-8859-1 \r\n";
            $from2 .= "From: " . utf8_decode("Seminario GrahamRoss Training") . " <" . utf8_decode("seminario@grt.mx") . ">\r\n";

            $mensaje = getMessage($Id, $imageName);

            if ($mensaje !== "") {

                try {
                    $destinatarios = $EmailCustom;

                    //Update Qr Envido
                    $mailSender = mail($destinatarios, "Registro Seminario GrahamRoss Training", utf8_decode($mensaje), $from2);

                    if ($mailSender) {
                        $cnn = mysqli_connect("localhost", "grtmx_registro", "_12qwasZX_", "grtmx_registro");
                        $query = "UPDATE EventosParticipantes SET QrEnviado='S', FechaEnvioQr=now(), urlQr='" . $imageName . "' WHERE Id='" . $Id . "'";
                        $result = mysqli_query($cnn, $query);
                        if (!mysqli_error($cnn)) {
                            echo '{"status": "Ok"}';
                        } else {
                            echo '{"status": "failUpdate"}';
                        }
                    } else {
                        echo '{"status": "errorMail"}';
                    }
                } catch (Exception $ex) {
                    echo '{"status": "fail2"}';
                    echo $ex->getTrace();
                }
            } else {
                echo '{"status": "fail3"}';
            }
        } else {
            echo '{"status": "fail4"}';
        }
        break;
}

function getMessage($id, $qr) {
    $registerList = new registerList();
    $json = $registerList->getRegister($id);

    $arr = json_decode($json, true);
    if ($arr["status"] === "success") {
        $msg = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Seminario</title>
   
    </head>

<body style="margin:0; padding:0;">
    <center>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="gap" height="35"></td>
                </tr>
            </tbody>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" valign="top">                   
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:5px;">
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:0px;">
                    <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
                        <tr>
                            <td align="center" valign="top" style="padding:1px;">
                                <img src="https://grt.mx/asistencia/images/confirmacion.png">                           
                            </td>
                        </tr>

                        <tr>
                            <td align="center" valign="top">                                
                                <img src="https://grt.mx/asistencia/register/tempqr/' . $qr . '" alt="QrName">
                            </td>
                        </tr>   
                        <tr>
                            <td align="center" valign="top">
                                <h2 style="color: #000; font-size:1.5em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">' . $arr["data"][0]["NombreCompleto"] . '</h2>
                            </td>
                        </tr>   
                        <tr>
                            <td align="center" valign="top">
                                <h2 style="color: #000; font-size:1.5em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">PROCEDENCIA: ' . $arr["data"][0]["Cuenta"] . '</h2>
                            </td>
                        </tr> 
                    </table>
                </td>                
            </tr>

            <tr>
                <td align="center" valign="top">
                    <h2 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">Este c&oacute;digo es personal e intransferible.</h2>
                </td>
            </tr>   
            <tr>
                <td align="center" valign="top">
                    <h2 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">* Es necesario presentar este c&oacute;digo al inicio del evento.</h2>
                </td>
            </tr>   
            <tr>
                <td align="center" valign="top">
                    <h2 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">* El evento no incluye comida, ni estacionamiento.</h2>
                </td>
            </tr>   
        </table>
    </center>
</body>           
            
</html>';
        return $msg;
    } else {
        return "";
    }
}
