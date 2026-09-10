<?php

// ENDPOINT POST - descricion.php 
// POST http://localhost/apis/rest/descripcion.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$referencias = $input["Refer"] ?? "";

$descripcionEncontrada = $db->buscarProducto($referencias);

if ($descripcionEncontrada) {
    echo json_encode([
        "success" => true,
        "mensaje" => "Descripcion encontrada",
        "referencia" => $descripcionEncontrada
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "El producto no existe"
    ]);
}

?>