<?php
// ENDPOINT PUT - actualizarCliente.php 
// PUT http://localhost/apis/rest/actualizarCliente.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$nit = $input["nit"] ?? "";
$razonsocial  = $input["descrip"] ?? "";

    if ($nit === "" || $razonsocial === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}

$ok = $db->actualizarClientes($razonsocial, $nit);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Cliente actualizado.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al actualizar el cliente.."]);
    }



?>