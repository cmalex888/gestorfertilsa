<?php
// ENDPOINT POST - product.php 
// POST http://localhost/apis/rest/product.php

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

$pk = $db->buscarProducto($referencia);

if($pk){
    echo json_encode(["error" => "El producto ya está creado"]);

}else{

$ok = $db->agregarProducto('NULL', $referencia, $descripcion, $unidadmedida, $valoruni);

    if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Producto registrado.."]);
    }else {
        echo json_encode(["success" => false, "mensaje" => "Error al registrar el producto.."]);
    }

}

?>