<?php
// ENDPOINT POST - inventarioDisponiblecorte.php 
// POST http://localhost/apis/rest/consumosInventario.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$bodegas = $input["bod"] ?? "";
$fecha = $input["fecha"] ?? "";
$fechaf = $input["fechaf"] ?? "";

if ($bodegas === "" || $fecha === "" || $fechaf === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}


$consumosCorte = $db->consultarConsumos($bodegas, $fecha, $fechaf);


if ($consumosCorte) {
    echo json_encode([
        "success" => true,
        "mensaje" => "consumos encontrados",
        "inventario" => $consumosCorte
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "No se evidencian consumos para esta bodega!"
    ]);
}
    

?>