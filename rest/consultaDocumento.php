<?php
// ENDPOINT POST - consultaDocumento.php 
// POST http://localhost/apis/rest/consultaDocumento.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$sigla = $input["prefijo"] ?? "";
$csc = $input["conse"] ?? "";


if ($sigla === "" || $csc === "") {
    echo json_encode(["error" => "Faltan datos"]);
    exit;
}


$documentoEncontrado = $db->consultarDocumento($sigla, $csc);


if ($documentoEncontrado) {
    echo json_encode([
        "success" => true,
        "mensaje" => "Consulta realizada con exito",
        "codigo" => $documentoEncontrado
    ]);
} else {
    echo json_encode([
        "success" => false,
        "mensaje" => "Error consulta"
    ]);
}
    

?>