<?php
// ENDPOINT DELETE - actualizarProducto.php 
// DELETE http://localhost/apis/rest/borrarMovimientos.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$siglas = $input["siglas"] ?? "";
$consecutivo = $input["csc"] ?? "";


    if ($siglas === "" || $consecutivo === "") {
    echo json_encode(["error" => "Los campos son obligatorios"]);
    exit;
}

$ok = $db->borraMovimiento($siglas, $consecutivo);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Movimiento borrado.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al borrar el movimiento.."]);
    }



?>