<!DOCTYPE html>

<?php
require_once "./phpqrcode/qrlib.php";

date_default_timezone_set('UTC');
//Agregamos la libreria para genera códigos QR
$timestamp = date('dmhms');


//Declaramos una carpeta temporal para guardar la imagenes generadas
$dir = 'tempqr/';

//Si no existe la carpeta la creamos
if (!file_exists($dir))
    mkdir($dir);


@$nombre = $_POST["nombre"];
@$paterno = $_POST["paterno"];
@$materno = $_POST["materno"];

@$txtNombre = $_GET["nombre"];
@$email = $_POST["email"];
@$telefono1 = $_POST["telefono1"];
@$puestoCargo = $_POST["puestoCargo"];
@$marcaAgencia = $_POST["marcaAgencia"];
@$calle = $_POST["calle"];
@$ciudad = $_POST["ciudad"];
@$Estado = $_POST["Estado"];
@$cp = $_POST["cp"];
@$pais = $_POST["pais"];
@$cumple = $_POST["cumple"];

$imageName = $timestamp . "Qr-" . $email . "." . "png";
$filename = $dir . $imageName;

$destinatario = "eduardo.contreras@grt.mx";
$de = $email;

$cabeceras = "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
$cabeceras .= utf8_decode("From: {$txtNombre}<{$de}>\r\n");
$cabeceras .= "Reply-To: {$de}\r\n";


//Parametros de Condiguración
$tamanio = 10; //Tamaño de Pixel
$level = 'Q'; //Precisión Baja
$framSize = 3; //Tamaño en blanco
//$contenido = "http://simposio.grt.mx/validate.php?idParticipante=";
$contenido = $txtNombre;
//Enviamos los parametros a la Función para generar código QR 
QRcode::png($contenido, $filename, $level, $tamanio, $framSize);

$mail2 = "<html>";
$mail2 .= "<head>";
$mail2 .= "<style type='text/css'>";
$mail2 .= "body,html{width:100%}body{text-align:-webkit-center;vertical-align:top;background:#333}table{font-size:14px;border:0}@media only screen and (max-width:768px){.container{width:650px}.container-middle{width:416px!important}table.ban{background:url(images/banner.jpg);background-size:cover;height:450px!important}}@media only screen and (max-width:736px){table.ser-section{float:left!important;width:40%!important;margin:2%!important}a.log,td.line span{font-size:3.5em!important}}@media only screen and (max-width:640px){table.ser-section{float:none!important;width:100%!important;margin:0!important}td.join,td.line.sec,td.price-para.sec{text-align:center!important}.container{width:580px}}@media only screen and (max-width:622px){.header-bg{width:422px!important;height:10px!important}.banner,.main-image,table.mainContent img{height:auto!important}table.ser-section{float:none!important;width:100%!important;margin:0!important}.container{width:500px!important}.container-middle{width:416px!important}.mainContent{width:550px!important}.banner,.main-image{width:216px!important}.img-responsive{width:100%}table.social{width:60%!important}}@media only screen and (max-width:600px){td.h-title,td.price{font-size:1.8em!important}.header-bg{width:280px!important;height:10px!important}.main-header,.main-subheader{line-height:28px!important;text-align:center!important}.container{width:560px!important}.container-middle{width:260px!important}.mainContent{width:500px!important}.main-image{width:560px!important;height:auto!important}table,table.ban{width:100%!important}table.ban{height:440px!important}td.top-text{height:22px}a.learn{padding:9px 12px!important;width:115px!important}td.line{font-size:.65em!important}td.price-para{font-size:.8em;line-height:1.9em;padding:0}td.price{line-height:25px!important}td.l-bottom{height:20px!important}table.ban2{background:url(images/bottom.jpg);background-size:cover;height:280px!important}td.sub-ht{font-size:1.5em!important}table.b-text{width:75%!important;margin:0 auto}table.menu{width:58%!important;margin:0 auto!important}a.log{font-size:3em!important}table.place_main{width:80%!important}table.ban3{width:100%!important;height:300px!important}td.high-top_w3layouts{height:50px!important}td.high-top_w3layouts.two{height:2px!important}td.h_bottom_w3ls_agile{height:35px!important}}@media only screen and (max-width:568px){.container{width:540px!important}.container-middle{width:260px!important}.mainContent{width:450px!important}td.high-top_w3layouts{height:40px!important}td.h_bottom_w3ls_agile{height:25px!important}td.scale-center-both{font-size:1.4em!important}}@media only screen and (max-width:480px){.header-bg{width:280px!important;height:10px!important}.logo,.top-header-left,.top-header-right{width:260px!important}.top-header-left{text-align:center!important}.main-header,.main-subheader{line-height:28px!important;text-align:center!important}.container{width:400px!important}.container-middle{width:260px!important}.mainContent{width:380px!important}td.h-t{font-size:2.5em!important}.main-image{width:222px!important;height:auto!important}.top-bottom-bg{width:260px!important;height:auto!important}table,table.ban{width:100%!important}a.log{font-size:2.2em!important}td.h-title,td.price{font-size:1.8em!important}table.ban{height:300px!important}a.learn{padding:9px 12px!important;width:115px!important}td.line{font-size:.65em!important}td.price-para{font-size:.8em;line-height:1.9em;padding:0}td.price{line-height:25px!important}td.l-bottom{height:20px!important}table.orenge{padding:0 2em!important}td.orenge-h{height:30px!important}td.sub-ht{font-size:1.3em!important}td.top-text{height:6px!important}table.b-text{width:75%!important;margin:9% auto 0!important}table.menu{width:76%!important;margin:0 auto!important}td.line span{font-size:3em!important}}@media only screen and (max-width:414px){a.log{font-size:2.2em!important}table.ban{width:100%!important;height:300px!important}a.learn{padding:8px 10px!important;width:70px!important}a.nav,a.nav.logo{padding:37px 8px!important}td.icon-social a img{Width:32px!important;height:32px!important;margin:0 2em}.container{width:370px!important}a.nav{margin-right:0!important}a.nav.logo{margin-right:5px!important;font-size:2.3em!important}.mainContent{width:336px!important}td.scale-center-both img{height:auto!important;width:100%!important}}@media only screen and (max-width:384px){.container{width:350px!important}a.nav{padding:37px 4px!important;margin-right:0!important}td.sub-ht{font-size:1.1em!important}}@media only screen and (max-width:320px){.container{width:290px!important}.mainContent{width:270px!important}table.b-text{width:90%!important;margin:13% auto 0!important}td.h-t{font-size:1.9em!important}table.menu{width:88%!important;margin:0 auto!important}a.nav.logo{margin-right:0!important;padding:37px 4px!important;font-size:2em!important}}";
$mail2 .= "</style>";
$mail2 .= "<title>Multimarca GRT</title>";
$mail2 .= "</head>";
$mail2 .= '<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">';
$mail2 .= '<table border="0" width="100%" cellpadding="0" cellspacing="0">';
$mail2 .= '<tr>';
$mail2 .= '<td height="60"></td>';
$mail2 .= '</tr>
            <tr>
                <td width="100%" align="center" valign="top">
                    <!-- main content -->
                    <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="container top-header-left">                       
                        <tr>
                            <td>
                                <table class="ban" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="FFFFFF" style="background: #333333; background-size:cover;"
                                       height="400">
                                    <tbody>
                                        <tr>
                                            <td valign="top">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="gap" height="35"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <!--head_part-->
                                                    <tbody>
                                                        <tr>
                                                            <td class="gap1" height="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table class="menu" style="margin: 0 auto; border-collaps:collaps; mso-table-lspace:0pt; mso-table-rspace:0pt;" align="center"
                                                                       border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="menu" align="center" style="text-align:left;">
                                                                                <a class="nav logo" style="">                                                                                	
                                                                                    <img src="http://simposio.grt.mx/images/grt_logotipo_sloganblanco.png"/>                                    	
                                                                                </a> 
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="10"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!--head_part-->
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table class="b-text" width="500" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 8px solid rgba(255, 255, 255, 0.16);"
                                                                       class="mainContent">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="top-text" height="1"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="top-text" height="20"></td>
                                                                        </tr>
                                                                        <tr align="center">
                                                                            <td><a class="log" href="#" style="color:#fff; font-family:Monotype Corsiva;font-size:4em;font-weight:bold;letter-spacing:1px;; text-decoration:none;">&iexcl;Gracias</span></a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="5"></td>
                                                                        </tr>

                                                                        <tr align="center">
                                                                            <td class="line"><span style="color:#fff;font-family:Monotype Corsiva;font-size:4em;font-weight:bold;letter-spacing:px;line-height:1.5em;text-decoration:none;">por tu registro!</span></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="high-top_w3layouts" height="30"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>                                       
                        <tr>
                            <td class="high-top_w3layouts" bgcolor="#FFF" height="40"></td>
                        </tr>
                        <td bgcolor="ffffff">
                            <table width="560" border="0" align="center" cellpadding="0" cellspacing="0" class="mainContent">
                                <tr>
                                    <td class="high-top_w3layouts two" height="30"></td>
                                </tr>
                                <tr>
                                    <td class="h-t" align="center" mc:edit="title1" class="main-header" style="color: #333; font-size:3em; font-family:Monotype Corsiva;font-weight:bold;">
                                        C&oacute;digo de confirmaci&oacute;n
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10"></td>
                                </tr>
                                <tr>
                                    <td class="sub-ht" align="center" mc:edit="title1" class="main-header" style="color: #E01931;font-size:1.6em; font-family:Letter Gothic Std;font-weight:600;">
                                        Octubre, 18 y 19, 2018
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h1  style="color: #777; font-size:1.2em; font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 2em;">Presenta el siguiente c&oacute;digo QR el d&iacute;a del evento.</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                </tr>
			<tr>
                <td class="high-top_w3layouts" height="30" align="center">
				
				</td>
            </tr>
                                <tr>
                                    <td align="center">
                                        <img src="http://simposio.grt.mx/register/tempqr/' . $imageName . '" alt="QrName">
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15"></td>
                                </tr>
                                <tr bgcolor="ffffff">
                                    <td mc:edit="text1" class="main-subheader" style="color: #777; font-size:0.9em;font-family:Letter Gothic Std;text-align:center; font-weight: normal; line-height: 2em;">
                                        <h3>T&eacute;rminos y Condiciones</h3>

                                        
                                        <p>Este registro es personal e intransferible. </p>

                                    </td>
                                </tr>
                                <tr>
                                    <td height="20"></td>
                                </tr>

                            </table>
                        </td>
                    </table>
                </td>
            </tr> 
            <tr>
                <td class="high-top_w3layouts" height="70" bgcolor="ffffff"></td>
            </tr>           
            <tr>
                <td class="high-top_w3layouts" height="30"></td>
            </tr>
            </table>';

$mail2 .= "</body>";
echo $mail2 .= "</html>";

$from2 = 'MIME-Version: 1.0' . "\r\n";
$from2 .= "Content-type: text/html; charset=iso-8859-1 \r\n";
$from2 .= "From: " . utf8_decode("Simposio GrahamRoss Training") . " <" . utf8_decode("contacto@grt.mx") . ">\r\n";

$send2 = mail("eduardo.contreras@grt.mx", "[Multimarca GrahamRoss Training] Gracias por tu registro!", utf8_decode($mail2), $from2);
