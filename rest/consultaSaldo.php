<?php
// ENDPOINT POST - consultaSaldo.php 
// POST http://localhost/apis/rest/consultaSaldo.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$ref = $input["refer"] ?? "";
$bodegas = $input["bod"] ?? "";


if ($ref === "" || $bodegas === "") {
    echo json_encode(["error" => "Faltan datos"]);
    exit;
}


$saldoEncontrado = $db->consultarSaldo($ref, $bodegas);


if ($saldoEncontrado) {
    echo json_encode([
        "success" => true,
        "mensaje" => "Saldo encontrado",
        "codigo" => $saldoEncontrado
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "El saldo no existe"
    ]);
}
    

?>