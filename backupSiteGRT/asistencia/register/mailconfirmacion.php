<!DOCTYPE html>

<?php
require_once "./phpqrcode/qrlib.php";

date_default_timezone_set('UTC');
//Agregamos la libreria para genera códigos QR
$timestamp = date('dmhms');


//Declaramos una carpeta temporal para guardar la imagenes generadas
$dir = 'tempqr/';

//Si no existe la carpeta la creamos
if (!file_exists($dir)) {
    mkdir($dir);
//    echo "crear tempqr/ <br>";
} else {
//    echo "existe tempqr/ <br>";
}

//@$txtNombre = utf8_encode($_POST["nombre"]);
@$txtNombre = utf8_encode($_GET["nombre"]);
@$email = $_POST["email"];
//@$txtCuenta = utf8_encode($_POST["cuenta"]);
@$txtCuenta = utf8_encode($_GET["cuenta"]);
@$Id = utf8_encode($_GET["Id"]);

$imageName = $timestamp . "Qr-" . $Id . "." . "png";
$filename = $dir . $imageName;

$destinatario = "eduardo.contreras@grt.mx";
$de = $email;



$cabeceras = "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
$cabeceras .= utf8_decode("From: {$txtNombre}<{$de}>\r\n");
$cabeceras .= "Reply-To: {$de}\r\n";


//Parametros de Condiguración
$tamanio = 8; //Tamaño de Pixel
$level = 'Q'; //Precisión Baja
$framSize = 2; //Tamaño en blanco
$contenido = "https://grt.mx/register/validate.php?Id=" . $Id;
//echo "<br>url:" . $contenido . " <br>";
//Enviamos los parametros a la Función para generar código QR 
QRcode::png($contenido, $filename, $level, $tamanio, $framSize);


$from2 = 'MIME-Version: 1.0' . "\r\n";
$from2 .= "Content-type: text/html; charset=iso-8859-1 \r\n";
$from2 .= "From: " . utf8_decode("Seminario GrahamRoss Training") . " <" . utf8_decode("seminario@grt.mx") . ">\r\n";
//$msg .= '<img src="http://simposio.grt.mx/register/tempqr/' . $imageName . '" alt="QrName">';
//$send2 = mail($email, "[GrahamRoss Training] Gracias por tu registro!", utf8_decode($mail2), $from2);
//$send2 = mail($email, "[GrahamRoss Training] Gracias por tu registro!", utf8_decode($mail2), $from2);
//    sendMessageThankYou($mail);
// the message
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
                                <img src="https://grt.mx/asistencia/register/tempqr/' . $imageName . '" alt="QrName">
                            </td>
                        </tr>   
                        <tr>
                            <td align="center" valign="top">
                                <h2 style="color: #000; font-size:1.5em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">' . $txtNombre . '</h2>
                            </td>
                        </tr>   
                        <tr>
                            <td align="center" valign="top">
                                <h2 style="color: #000; font-size:1.5em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">PROCEDENCIA: ' . $txtCuenta . '</h2>
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
// send email

//echo $msg;
//mail($email, "[GrahamRoss Training] Gracias por tu registro!", utf8_decode($msg), $from2);
try {
//    $destinatarios = "" . $email . ", eduardo.contreras@grt.mx";
//    $destinatarios = "" . $email . ", eduardo.contreras@grt.mx, neri.lozano@grt.mx, nancy.gallegos@grt.mx";
//    $destinatarios = "" . $email . "";
//    mail($destinatarios, "[GrahamRoss Training] Gracias por tu registro!", utf8_decode($msg), $from2);
    mail("eduardo.contreras@grt.mx", "[GrahamRoss Training] Registro!", utf8_decode($msg), $from2);
    echo '{"status": "valid"}';
    
} catch (Exception $ex) {
    echo '{"status": "fail"}';
//    echo $ex->getTrace();
}

