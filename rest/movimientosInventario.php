<?php
// ENDPOINT POST - movimientosInventario.php 
// POST http://localhost/apis/rest/movimientosInventario.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$fechai = $input["fecha"] ?? "";
$bodega = $input["bod"] ?? "";
$ref = $input["refer"] ?? "";
$fechain = $input["fecha"] ?? "";
$fechaf = $input["fechaf"] ?? "";
$bodegaf = $input["bod"] ?? "";
$reff = $input["refer"] ?? "";




if ($fechai === "" || $bodega === "" || $ref === "" || $fechain === "" || $fechaf === "" || $bodegaf === "" || $reff === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}


$movimientosAlcorte = $db->consultarMovimientos($fechai, $bodega, $ref, $fechain, $fechaf, $bodegaf, $reff);


if ($movimientosAlcorte) {
    echo json_encode([
        "success" => true,
        "mensaje" => "movimientos encontrados",
        "inventario" => $movimientosAlcorte
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "No existen movimientos!"
    ]);
}
    

?>