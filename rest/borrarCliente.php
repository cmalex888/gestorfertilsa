<?php
// ENDPOINT DELETE - borrarCliente.php 
// DELETE http://localhost/apis/rest/borrarCliente.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$nit = $input["nit"] ?? "";


    if ($nit === "") {
    echo json_encode(["error" => "El nit es obligatorio"]);
    exit;
}

$ok = $db->borraCliente($nit);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Cliente borrado.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al borrar el cliente.."]);
    }



?>