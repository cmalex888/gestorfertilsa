<?php
// ENDPOINT PUT - actualizarProducto.php 
// PUT http://localhost/apis/rest/actualizarProducto.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$referencia = $input["refer"] ?? "";
$descripcion  = $input["descript"] ?? "";
$unidadmedida = $input["unidad"] ?? "";
$valoruni = $input["val"] ?? "";

    if ($referencia === "" || $valoruni === "" || $descripcion === "" || $unidadmedida === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}

$ok = $db->actualizarProductos($descripcion, $unidadmedida, $valoruni, $referencia);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Producto actualizado.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al actualizar el producto.."]);
    }



?>