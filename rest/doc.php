<?php
// ENDPOINT POST - doc.php 
// POST http://localhost/apis/rest/doc.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$tipo = $input["tipo"] ?? "";
$sigla  = $input["sigla"] ?? "";
$descripcion = $input["descrip"] ?? "";


if ($tipo === "" || $sigla === "" || $descripcion === "") {
    echo json_encode(["error" => "Todos los campos obligatorios"]);
    exit;
}

$pk = $db->buscarDocumento($sigla, $tipo);

if($pk){
    echo json_encode(["error" => "El tipo de documento ya está creado"]);
}else{

$ok = $db->agregarDocumento('NULL', $tipo, $sigla, $descripcion);

    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Documento registrado.."]);
    } else {
        echo json_encode(["success" => false, "mensaje" => "Error al registrar el documento.."]);
    }

}


?>