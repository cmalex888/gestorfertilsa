<?php
// ENDPOINT PUT - actualizarBodega.php 
// PUT http://localhost/apis/rest/actualizarBodega.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$codigob = $input["cod"] ?? "";
$descripb  = $input["nombreb"] ?? "";
$direcb = $input["direc"] ?? "";
$ciudadbg = $input["ciudadb"] ?? "";
$phoneb = $input["phone"] ?? "";

    if ($codigob === "" || $descripb === "" || $direcb === "" || $ciudadbg === "" || $phoneb === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}

$ok = $db->actualizarBodegas($descripb, $direcb, $ciudadbg, $phoneb, $codigob);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "bodega actualizada.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al actualizar la bodega.."]);
    }



?>