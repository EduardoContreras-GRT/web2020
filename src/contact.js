 contact = function() {

    var valid = validateForm();

    if(valid){
               
        var txtName = $("#txtName").val();
        var txtPhone = $("#txtPhone").val();
        var txtMail = $("#txtMail").val();
        var txtCompany = $("#txtCompany").val();
        var txtHow = $("#txtHow").val();
    

        var settings = {
            url : "src/contact.php",
            method : "POST",
            timeout : 0,
            data : {
                txtName : txtName,
                txtPhone : txtPhone,
                txtMail : txtMail,
                txtCompany : txtCompany,
                txtHow : txtHow
            },
            dataType : "json"
        };
        
        $.ajax(settings).done(function (response) {
            if(response != ""){
                if(response.status === "success"){
                    var message = "Un profesional de nuestra área de contacto, se comunicará contigo a la brevedad";
                    $("#divAlertMessage").html("<strong>Hola! </strong> <br>" + message);
                    $("#divContentAlert").toggle();
                    $("#frmContact")[0].reset();
                    alert(message);
                    $('#exampleModal2').modal('hide')

                }else{
                    var message = "Intenta enviar de nuevo el formulario";
                    $("#divAlertMessage").html("<strong>Ups! </strong> <br>" + message);
                    $("#divContentAlert").toggle();
                    console.log("Something wrong");
                 }
            }else{               
                    var message = "Algo no va bien!, envianos un correo a contacto@grt.mx";
                    $("#divAlertMessage").html("<strong>=(</strong> <br>" + message);
                    $("#divContentAlert").toggle();
                console.log("Response without data");
            }
        });
    }   
};


validateForm = function (){

    console.log("Validando");

    var txtName = $("#txtName").val();
    var txtPhone = $("#txtPhone").val();
    var txtMail = $("#txtMail").val();
    var txtHow = $("#txtHow").val();
    var valid = false;
    var message = "";

    message += ($.trim(txtName) == "") ? "Es necesario escribir tu nombre <br>" : "";
    message += ($.trim(txtPhone) == "") ? "Es necesario escribir tu telefono <br>" : "";
    message += ($.trim(txtMail) == "") ? "Es necesario escribir tu email <br>" : "";
    message += ($.trim(txtHow) == "") ? "Es necesario escribir como te podemos ayduar <br>" : "";

    if($.trim(message) != ""){
        $("#divAlertMessage").html("<strong>Atenci&oacute;n</strong> <br>" + message);
        $("#divContentAlert").toggle();
        valid = false;
    }else{
        valid = true;
        $("#divAlertMessage").html("<strong>Atenci&oacute;n</strong> Enviando tu información <br>");
        $("#divContentAlert").toggle();
    }

    return valid;
}