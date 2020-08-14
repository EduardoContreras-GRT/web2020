<?php

@$txtName = $_POST["txtName"];
@$txtPhone = $_POST["txtPhone"];
@$txtMail = $_POST["txtMail"];
@$txtCompany = $_POST["txtCompany"];
@$txtHow = $_POST["txtHow"];



$url = "https://hooks.zapier.com/hooks/catch/3888697/ozebwun?name=" . urlencode($txtName) . "&phone=" . urlencode($txtPhone) . "&mail=" . urlencode($txtMail) . "&company=" . urlencode($txtCompany) . "&how=" . urlencode($txtHow);

 $curl = curl_init();

 curl_setopt_array($curl, array(
   CURLOPT_URL => $url,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "POST",
 ));
 
 $response = curl_exec($curl);
 
 curl_close($curl);
 echo $response;