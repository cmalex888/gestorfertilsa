<?php

// ENDPOINT POST - nombrebodega.php 
// POST http://localhost/apis/rest/nombrebodega.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$codigob = $input["cod"] ?? "";

$nombreEncontrado = $db->buscarBodega($codigob);

if ($nombreEncontrado) {
    echo json_encode([
        "success" => true,
        "mensaje" => "Nombre encontrado",
        "codigo" => $nombreEncontrado
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "La bodega no existe"
    ]);
}

?>