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

@$txtNombre = utf8_encode($_POST["nombre"]);
@$email = $_POST["email"];
@$txtCuenta = utf8_encode($_POST["cuenta"]);

$imageName = $timestamp . "Qr-" . $email . "." . "png";
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
$contenido = "http://multimarca.grt.mx/validate.php?name=" . $txtNombre . "&email=" . $email;
//echo "<br>url:" . $contenido . " <br>";
//Enviamos los parametros a la Función para generar código QR 
QRcode::png($contenido, $filename, $level, $tamanio, $framSize);


$from2 = 'MIME-Version: 1.0' . "\r\n";
$from2 .= "Content-type: text/html; charset=iso-8859-1 \r\n";
$from2 .= "From: " . utf8_decode("Multimarca GrahamRoss Training") . " <" . utf8_decode("contacto@grt.mx") . ">\r\n";
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

        <title>Multimarca</title>

        <style type="text/css">
        </style>    
    </head>

<body style="margin:0; padding:0; background-color:#def3ff;">
    <center>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="gap" height="35"></td>
                </tr>
            </tbody>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#def3ff">
            <tr>
                <td align="center" valign="top">
                    <a class="nav logo" style="">                                                                                	
                        <img src="http://simposio.grt.mx/images/grt_logotipo_sloganblanco.png"/>                                    	
                    </a> 
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:5px;">

                    <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
                        <tr>
                            <td align="center" valign="top" style="padding:10px;">
                                <h1 style="color: #000; font-size:2.2em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    &iexcl;Gracias por tu registro!
                                </h1> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:0px;">
                    <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
                        <tr>
                            <td align="center" valign="top" style="padding:1px;">
                                <h1 style="color: #000; font-size:2em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    C&oacute;digo de confirmaci&oacute;n
                                </h1>                               
                            </td>
                        </tr>

                        <tr>                            
                            <td colspan="2" align="center" valign="top" style="padding:10px;">
                                <h2 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">Presenta el siguiente c&oacute;digo QR el d&iacute;a del evento.</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">                                
                                <img src="http://simposio.grt.mx/register/tempqr/' . $imageName . '" alt="QrName">
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


                    <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:600px; width:100%;">
                        <tr>
                            <td align="center" valign="top" style="padding:10px;">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Curso Multimarca Hermosillo
                                </h1>
                            </td>
                            <td align="center" valign="top" style="padding:10px;">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">Octubre, 18 - 19, 2018</h1>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; ">
                                    Horarios:
                                </h1>
                            </td>                            
                        </tr>
                        <tr>
                            <td colspan="2" align="left" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:left; font-weight: normal; ">
                                    D&iacute;a 1
                                </h1>
                            </td>                            
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Mesa de registro
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 8:00 - 8:50 hrs </h1>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Curso
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 9:00 - 13:00 hrs </h1>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Comida*
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 13:00 - 14:30 hrs </h1>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Curso
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 14:30 - 18:30 hrs </h1>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:left; font-weight: normal; ">
                                    D&iacute;a 2
                                </h1>
                            </td>                            
                        </tr>                       
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Curso
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 9:00 - 13:00 hrs </h1>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Comida*
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 13:00 - 14:30 hrs </h1>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">
                                    Curso
                                </h1>
                            </td>
                            <td align="center" valign="top">
                                <h1 style="color: #eb6419; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal;"> 14:30 - 18:30 hrs </h1>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="left" valign="top">
                                <h1 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:left; font-weight: normal; ">
                                    Sede:
                                </h1>
                            </td>                            
                        </tr>                       
                        <tr>
                            <td  colspan="2" align="center" valign="top">
                                <p style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">                                                             
                                    Holiday Inn & Suites Hermosillo Aeropuerto
                                    Av. Jesus Garc&iacute;a Morales
                                    (Entre Blvd. Dr. Antonio Quiroga y calle Agust&iacute;n G&oacute;mez del Campo)
                                    Colonia El Llano C.P. 83210 Hermosillo, Sonora
                                    T: 52+ (662) 500 46 15/16                                                                       
                                </p>
                            </td>                            
                        </tr>
                        <tr>
                            <td  colspan="2" align="center" valign="top">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13945.289600417813!2d-111.03310125661639!3d29.09616181657424!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1961d9686b64ae9f!2sHoliday+Inn+Hotel+%26+Suites+Hermosillo+Aeropuerto!5e0!3m2!1sen!2smx!4v1539708522462" width="600" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
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
                    <h2 style="color: #000; font-size:1.0em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 1em;">* El evento no incluye comida, ni estacionamiento.</h2>
                </td>
            </tr>   
        </table>
    </center>
</body>           
            
</html>';
// send email

echo "mail:" . $msg . "<br>";
//mail($email, "[GrahamRoss Training] Gracias por tu registro!", utf8_decode($msg), $from2);
try {
//    $destinatarios = "" . $email . ", eduardo.contreras@grt.mx";
    $destinatarios = "" . $email . ", eduardo.contreras@grt.mx, neri.lozano@grt.mx, nancy.gallegos@grt.mx";
    mail($destinatarios, "[GrahamRoss Training] Gracias por tu registro!", utf8_decode($msg), $from2);
} catch (Exception $ex) {
    echo $ex->getTrace();
}

