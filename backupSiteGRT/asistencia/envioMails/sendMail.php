<?php

$json = include './mailList.json';

$jsonObjt = json_decode($json);

foreach ($jsonObjt as $jsonData) {
    echo $jsonData, "\n";
}