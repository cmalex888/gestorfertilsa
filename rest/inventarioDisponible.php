<?php
// ENDPOINT POST - inventarioDisponible.php 
// POST http://localhost/apis/rest/inventarioDisponible.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$bodegas = $input["bod"] ?? "";


if ($bodegas === "") {
    echo json_encode(["error" => "Por favor registre la bodega"]);
    exit;
}


$inventarioEncontrado = $db->consultarDisponible($bodegas);


if ($inventarioEncontrado) {
    echo json_encode([
        "success" => true,
        "mensaje" => "inventario encontrado",
        "inventario" => $inventarioEncontrado
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "No hay inventario disponible para esta bodega!"
    ]);
}
    

?>