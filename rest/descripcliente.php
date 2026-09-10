<?php

// ENDPOINT POST - descripcliente.php 
// POST http://localhost/apis/rest/descripcliente.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$nitcliente = $input["nit"] ?? "";

$razonEncontrada = $db->buscarcliente($nitcliente);

if ($razonEncontrada) {
    echo json_encode([
        "success" => true,
        "mensaje" => "Descripcion encontrada",
        "nit" => $razonEncontrada
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "El NIT no existe"
    ]);
}

?>