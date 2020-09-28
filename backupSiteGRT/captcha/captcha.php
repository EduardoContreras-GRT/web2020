<?php

$secret = "6Leo_-oUAAAAAJlf9EEctv_ey4qRxr6B1EJFWAPN";
@$response = $_POST["g-recaptcha-response"];
if (!empty($response)) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $respuestaValidacion = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
    $jsonResponde = json_decode($respuestaValidacion);
    if ($jsonResponde->success) {

        @$name = $_POST["name"];
        @$email = $_POST["email"];
        @$number = $_POST["number"];
        @$message = $_POST["message"];

        $url = "https://hooks.zapier.com/hooks/catch/3888697/o59te18/";
        $urlGet = $url . "?name=" . $name . "&email=" . $email . "&number=" . $number . "&message=" . $message;

        $urlGet = str_replace(" ", "%20", $urlGet);
        $responseForm = file_get_contents($urlGet);

        if ($responseForm != "") {
            $responseForm = json_decode($responseForm);

            if ($responseForm->status == "success") {
                echo '<script>window.parent.responseForm(1);</script>';
                echo '{status:"success"}';
            } else {
                echo '<script>window.parent.responseForm(2);</script>';
                echo '{status:"no se guardo"}';
            }
        } else {
            echo '<script>window.parent.responseForm(3);</script>';
            echo '{status:"No se envio"}';
        }
    } else {
        //Google ha detectado que se trata de un proceso no humano
        echo '<script>window.parent.responseForm(4);</script>';
        echo '{status:"boot"}';
    }
} else {
    echo '<script>window.parent.responseForm(5);</script>';
    echo '{status:"missing"}';
//    echo '{status:"missing"}';
}