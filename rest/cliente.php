<?php
// ENDPOINT POST - doc.php 
// POST http://localhost/apis/rest/cliente.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$nit = $input["nit"] ?? "";
$razonsocial  = $input["descrip"] ?? "";


if ($nit === "" || $razonsocial === "") {
    echo json_encode(["error" => "Todos los campos obligatorios"]);
    exit;
}

$pk = $db->buscarcliente($nit);

if($pk){
    echo json_encode(["error" => "El nit ya está creado"]);
}else{

$ok = $db->agregarcliente($nit, $razonsocial);

    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Cliente registrado.."]);
    } else {
        echo json_encode(["success" => false, "mensaje" => "Error al registrar el cliente.."]);
    }

}


?>