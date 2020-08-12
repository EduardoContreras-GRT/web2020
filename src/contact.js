 contact = function() {
    var txtName = $("#txtName").value;
    var txtPhone = $("#txtPhone").value;
    var txtMail = $("#txtMail").value;
    var txtCompany = $("#txtCompany").value;
    var txtHow = $("#txtHow").value;
    var settings = {
        "url": "src/contact.php",
        "method": "POST",
        "timeout": 0,
        "params" : {
            txtName:txtName,
            txtPhone:txtPhone,
            txtMail:txtMail,
            txtCompany:txtCompany,
            txtHow:txtHow
        },
        "dataType":"json"
    };
    
    $.ajax(settings).done(function (response) {
        if(response != ""){
            if(response.status === "success"){
                alert("Un profesional de nuestra área de contacto, se comunicará contigo a la brevedad");
                $("#frmContact")[0].reset();
            }else{
                alert("Intenta enviar de nuevo el formulario");
                console.log("Something wrong");
             }
        }else{
            alert("Algo no va bien!, envianos un correo a contacto@grt.mx");
            console.log("Response without data");
        }
    });

};