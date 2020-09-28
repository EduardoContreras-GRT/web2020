<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Sender</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>       
        <input type="hidden" value="" id="hddIdParticipante" name="hddIdParticipante">

        <div class="content">
            Sede:
            <select class="input" id="Sede" name="Sede" onchange="loadSender();">
                <option value="">----Seleccione----</option>
                <option value="1">Le&oacute;n</option>
                <option value="2">Guadalajara</option>
                <option value="3">Monterrey</option>
                <option value="4">M&eacute;rida</option>
            </select>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">QR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="ImageQrModal"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                     
                    </div>
                </div>
            </div>
        </div>

        <div id="myTable" class="col-md-10">          
        </div>

        <script>

//            $(function () {
//                
//
//            });

            loadSender = function () {

                $.ajax({
                    type: "POST",
                    url: "registerList.php",
                    data: {
                        accion: "getAllInSede",
                        Sede: $("#Sede").val()
                    },
                    async: false,
                    dataType: "json",
                    beforeSend: function () {
                    },
                    success: function (datos) {
                        if (datos != "") {
                            if (datos.status == "success") {
                                var tbl = "<h2>Total de Registros: <b>" + datos.totalCount + "</b></h2><br/><br/><table class='table table-striped table-sm'>";
                                tbl += "<thead>";
                                tbl += "<th>Nombre</th>";
                                tbl += "<th>Email</th>";
                                tbl += "<th>Marca / Agencia</th>";
                                tbl += "<th>Puesto</th>";
                                tbl += "<th>Evento</th>";
                                tbl += "<th>Fecha envio</th>";
                                tbl += "<th>Qr</th>";
                                tbl += "<th>Resend</th>";
                                tbl += "<th>Other</th>";
                                
                                tbl += "</thead>";
                                tbl += "<tbody>";
                                $.each(datos.data, function (index, element) {
//                                    var htmlOpcion = "<option value='" + element.cveTipoDia + "'>";
//                                    htmlOpcion += element.descTipoDia;
//                                    htmlOpcion += "</option>";
//                                    $("#cmbTiposdias").append(htmlOpcion);

                                    tbl += "<tr>";
                                    tbl += "<td>" + element.NombreCompleto + "</td>";
                                    tbl += "<td>" + element.Correo + "</td>";
                                    tbl += "<td>" + element.Cuenta + "</td>";
                                    tbl += "<td>" + element.Cargo + "</td>";
                                    tbl += "<td>" + element.Evento + "</td>";
                                    tbl += "<td>" + element.FechaEnvioQr + "</td>";
                                    if (element.QrEnviado === 'S') {
                                        tbl += '<td><button type="button" class="btn btn-primary" data-toggle="modal" onclick="OpenQr(\'' + element.urlQr + '\')" data-target="#exampleModal">Ver Qr</button></td>';
                                        tbl += "<td><input class='input btn btn-success' type='button' onclick='sendQr(" + element.Id + ")' value='Reenviar QR' ></td>";
                                        tbl += "<td><input class='input btn btn-info' type='button' onclick='sendCustomQr(" + element.Id + ")' value='Otro email' >";
                                        tbl += '</td>';
                                    } else {
                                        tbl += "<td><input class='input btn btn-success' type='button' onclick='sendQr(" + element.Id + ")' value='QR' ></td>";
                                        tbl += "<td></td>";
                                        tbl += "<td></td>";
                                    }
                                    tbl += "</tr>";
                                });
                                tbl += "</tbody>";

                                $("#myTable").html(tbl);
                            } else {
                                $("#myTable").html("");
                                tbl = "<tbody>";
                                tbl += "<thead>";
                                tbl += "<th>Sin Resultados</th>";
                                tbl += "</thead>";
                                tbl += "</tbody>";
                                $("#myTable").html(tbl);
                            }
                        }
                    }, complete: function () {

                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            };

            sendQr = function (id) {
                $.ajax({
                    type: "POST",
                    url: "registerList.php",
                    data: {
                        accion: "sendQr",
                        Id: id
                    },
                    async: false,
                    dataType: "json",
                    beforeSend: function () {
                    },
                    success: function (datos) {
                        loadSender();
                    }, complete: function () {

                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });

            };
            sendCustomQr = function (id) {

                var mail = "";

                mail = prompt("Ingresa un email...");

                if (mail !== "") {
                    $.ajax({
                        type: "POST",
                        url: "registerList.php",
                        data: {
                            accion: "sendCustomQr",
                            Id: id,
                            EmailCustom: mail
                        },
                        async: false,
                        dataType: "json",
                        beforeSend: function () {
                        },
                        success: function (datos) {
                            loadSender();
                        }, complete: function () {

                        },
                        error: function (objeto, quepaso, otroobj) {
                        }
                    });

                } else {
                    alert("Por favor ingresa un email!");
                }
            };

            OpenQr = function (url) {
                $("#ImageQrModal").html("");
                var html = "<img src='https://grt.mx/asistencia/register/tempqr/" + url + "'>";
                $("#ImageQrModal").html(html);
            };

        </script>
    </body>
</html>
