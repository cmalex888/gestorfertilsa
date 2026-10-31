<?php
// ENDPOINT POST - inventarioDisponiblecorte.php 
// POST http://localhost/apis/rest/inventarioDisponiblecorte.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$bodegas = $input["bod"] ?? "";
$fecha = $input["fecha"] ?? "";

if ($bodegas === "" || $fecha === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}


$inventarioAlcorte = $db->consultarDisponiblecorte($bodegas, $fecha);


if ($inventarioAlcorte) {
    echo json_encode([
        "success" => true,
        "mensaje" => "inventario encontrado",
        "inventario" => $inventarioAlcorte
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "No hay inventario o la bodega no exite!"
    ]);
}
    

?>