<?php
// ENDPOINT POST - insertarEntrada.php
// POST http://localhost/apis/rest/insertarSalida.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$fecha = $input["fechar"] ?? "";
$prefijo  = $input["prefijo"] ?? "";
$csc = $input["conse"] ?? "";
$ref = $input["refer"] ?? "";
$descrip = $input["descrip_pro"] ?? "";
$um = $input["unidad"] ?? "";
$cantidads = $input["centrada"] ?? "";
$observa = $input["obser"] ?? "";
$bodegae = $input["bod"] ?? "";
$nit = $input["nites"] ?? "";


if ($fecha === "" || $prefijo === "" || $csc === "" || $ref === "" || $descrip === "" || $um === "" || $cantidads === "" || $observa === "" || $bodegae === "" || $nit === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}


$ok = $db->agregarSalida('NULL', $fecha, $prefijo, $csc, $ref, $descrip, $um, 'NULL', $cantidads, $observa, $bodegae, $nit);

if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Salida registrada.."]);
}else {
        echo json_encode(["success" => false, "mensaje" => "Error al registrar la salida.."]);
}


?>