<?php
// ENDPOINT DELETE - actualizarProducto.php 
// DELETE http://localhost/apis/rest/borrarProducto.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$referencia = $input["refer"] ?? "";


    if ($referencia === "") {
    echo json_encode(["error" => "La referencia es obligatoria"]);
    exit;
}

$ok = $db->borraProductos($referencia);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Producto borrado.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al borrar el producto.."]);
    }



?>