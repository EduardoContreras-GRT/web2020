<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Validate</title>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
        <?php
        @$idParticipante = $_GET["idParticipante"];
        ?>
        <input type="hidden" value="<?php echo @$idParticipante; ?>" id="hddIdParticipante" name="hddIdParticipante">

        <div id="myTable" class="col-md-10">          
        </div>

        <script>

            $(function () {
                if ($.trim($("#hddIdParticipante").val()) != "") {
                    $.ajax({
                        type: "POST",
                        url: "register/registerList.php",
                        data: {
                            accion: "getRegister",
                            idParticipante: $("#hddIdParticipante").val()
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
                                    tbl += "<th>Fecha Asistencia</th>";
                                    tbl += "</thead>";
                                    tbl += "<tbody>";
                                    $.each(datos.data, function (index, element) {
//                                    var htmlOpcion = "<option value='" + element.cveTipoDia + "'>";
//                                    htmlOpcion += element.descTipoDia;
//                                    htmlOpcion += "</option>";
//                                    $("#cmbTiposdias").append(htmlOpcion);
                                        if (element.Asistencia == "N") {
                                            tbl += "<tr style='background: #9df19b4d' onclick='changeAsist(" + $("#hddIdParticipante").val() + ")'>";
                                        } else if (element.Asistencia == "S") {
                                            alert("Ya Registrado!");
                                            tbl += "<tr style='background: #ffc3c3'>";
                                        }

                                        tbl += "<td>" + element.NombreCompleto + "</td>";
                                        tbl += "<td>" + element.Correo + "</td>";
                                        tbl += "<td>" + element.Cuenta + "</td>";
                                        tbl += "<td>" + element.Cargo + "</td>";
                                        tbl += "<td>" + element.Evento + "</td>";
                                        tbl += "<td>" + element.FechaAsistencia + "</td>";
                                        tbl += "</tr>";
                                    });
                                    tbl += "</tbody>";

                                    $("#myTable").html(tbl);
                                }
                            }
                        }, complete: function () {

                        },
                        error: function (objeto, quepaso, otroobj) {
                        }
                    });
                } else {
                    console.log("algo paso con el numero: ");
                }

            });

            changeAsist = function (id) {

                $.ajax({
                    type: "POST",
                    url: "register/registerList.php",
                    data: {
                        accion: "setAssistence",
                        idParticipante: id
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
                                tbl += "<th>Fecha Asistencia</th>";
                                tbl += "</thead>";
                                tbl += "<tbody>";
                                $.each(datos.data, function (index, element) {
                                    tbl += "<tr>";
                                    tbl += "<td>" + element.NombreCompleto + "</td>";
                                    tbl += "<td>" + element.Correo + "</td>";
                                    tbl += "<td>" + element.Cuenta + "</td>";
                                    tbl += "<td>" + element.Cargo + "</td>";
                                    tbl += "<td>" + element.Evento + "</td>";
                                    tbl += "<td>" + element.FechaAsistencia + "</td>";
                                    tbl += "</tr>";
                                });
                                tbl += "</tbody>";

                                $("#myTable").html(tbl);
                            }
                        }
                    }, complete: function () {

                    },
                    error: function (objeto, quepaso, otroobj) {
                    }
                });
            }
        </script>

    </body>
</html>
