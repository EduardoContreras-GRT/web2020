<!--author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
@$idCurso = $_GET["Id"];
?>

<!DOCTYPE html>
<html>
    <head>

        <title>Registro de Participantes | Hyundai</title>
        <!-- metatags-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="ventas online, simposio de ventas, ventas digitales, bmp'online, PCG, Graham Ross, T&eacute;cnicas de ventas, cursos de ventas digitales, c&oacute;mo vender online, mejores t&eacute;cnicas, curso gratis, simposio gratis, aumentar tus ventas automotrices, ventas de autos por Internet">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Meta tag Keywords -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/><!--style_sheet-->
        <link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,600,700" rel="stylesheet">
        <!--online_fonts-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



        <script>
            $(function () {

                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '< Ant',
                    nextText: 'Sig >',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi�', 'Juv', 'Vie', 'S�b'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S�'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd/mm/yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);
                $("#cumple").datepicker();
            });

            validaAviso = function () {
                if ($("#aviso").prop("checked")) {
                    $("#btnSend").prop("disabled", false);
                } else {
                    $("#btnSend").prop("disabled", true);
                }
            }
        </script>
    </head>
    <body>
        <h1>GrahamRoss Training</h1>
        <div class="w3ls-main">
            <h2>Formulario de Registro</h2>
            <p>Completa el formulario para registrarte al curso.</p>
            <div class="w3ls-form">
                <form action="register/register.php" method="post">
                    <input type="text" id="hddIdCurso" name="hddIdCurso" value="<?php echo $idCurso; ?>">
                    <ul class="fields">
                        <div class="Refer_w3l">
                            <!--<h3>Your details</h3>-->
                            <li>	
                                <label class="w3ls-opt">Nombre:<span class="w3ls-star"> * </span></label>
                                <div class="w3ls-name">	
                                    <input type="text" name="nombre" id="nombre"  placeholder="Nombre" required=" "/>
                                </div>
                            </li>
                            <li>	
                                <label class="w3ls-opt">Apellido Paterno:<span class="w3ls-star"> * </span></label>
                                <div class="w3ls-name">	
                                    <input type="text" name="paterno" id="paterno" placeholder="Apellido Paterno" required=" "/>
                                </div>
                            </li>
                            <li>	
                                <label class="w3ls-opt">Apellido Materno:<span class="w3ls-star"> * </span></label>
                                <div class="w3ls-name">	
                                    <input type="text" name="materno" id="materno" placeholder="Apellido Materno" required=" "/>
                                </div>
                            </li>                           
                            <li>
                                <div class="mail">
                                    <label class="w3ls-opt">E-mail :<span class="w3ls-star"> * </span></label>
                                    <span class="w3ls-text w3ls-name">
                                        <input type="email" name="email" id="email" placeholder="mail@tudominio.com" required=""/>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <label class="w3ls-opt">M&oacute;vil :<span class="w3ls-star"> * </span></label>	
                                <span class="w3ls-text w3ls-name">
                                    <input type="text" name="telefono1" id="telefono1" placeholder="(xxx) xxx xxxx" required=""/>
                                </span>
                            </li>

                            <li>
                                <label class="w3ls-opt">Puesto :<span class="w3ls-star"> * </span></label>	
                                <span class="w3ls-text w3ls-name">
                                    <input type="text" id="puestoCargo"  name="puestoCargo" placeholder="Puesto" required=""/>
                                </span>
                            </li>

                            <li>
                                <label class="w3ls-opt">Marca o Agencia:<span class="w3ls-star"> * </span></label>	
                                <span class="w3ls-text w3ls-name">
                                    <input type="text" id="marcaAgencia" name="marcaAgencia" placeholder="Marca o Agencia" required=""/>
                                </span>
                            </li>                            
                            <li>
                                <label class="w3ls-opt">Fecha de cumplea�os:<span class="w3ls-star"> * </span></label>	

                                <div class="w3ls-text w3ls-name">
                                    <span class="text">    
                                        <input type="text" id="cumple" name="cumple" placeholder="Fecha de Cumplea�os" required="">
                                    </span>                                   
                                </div>

                            </li> 
                            <li>
                               	<label>
                                    <p style="font-size: 0.9em;">Aviso de Privacidad <a target="_blank" href="../aviso.html">(ver aviso de privacidad)</a></p>
                                    <input onClick="validaAviso();" type="checkbox" name="aviso" id="aviso" >
                                </label>                                 
                        </div>
                        </li>                             
                        </div>
                        <div class="Refer_w3l">
                            <h3>Reglas del registro</h3>

                            <p>1. Este evento es exclusivo y sin costo. Patrocinado por GrahamRoss Training. </p>

                            <p>2. Este registro es personal e intransferible. </p>

                        </div>
                        <p>Al finalizar este registro, te llegar&aacute; un c&oacute;digo de confirmaci&oacute;n que deber&aacute;s presentar el d&iacute;a del evento.</p>
                    </ul>
                    <div class="clear"></div>
                    <div class="w3ls-btn">
                        <input type="submit" disabled="true" id="btnSend" name="btnSend" value="Enviar Registro">
                    </div>
                </form>
            </div>
        </div>
        <footer>&copy; 2018 GrahamRoss Training. All Rights Reserved</a></footer>
</body>
</html>