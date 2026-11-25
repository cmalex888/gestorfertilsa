<?php
// ENDPOINT DELETE - actualizarProducto.php 
// DELETE http://localhost/apis/rest/borrarBodega.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$codigo = $input["cod"] ?? "";


    if ($codigo === "") {
    echo json_encode(["error" => "La bodega es obligatoria"]);
    exit;
}

$ok = $db->borraBodega($codigo);


    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Bodega borrada.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al borrar la bodega.."]);
    }



?>