<?php
// ENDPOINT POST - insertarEntrada.php
// POST http://localhost/apis/rest/insertarEntrada.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);


$fecha = $input["fechar"] ?? "";
$prefijo  = $input["prefijo"] ?? "";
$csc = $input["conse"] ?? "";
$ref = $input["refer"] ?? "";
$descrip = $input["descrip_pro"] ?? "";
$um = $input["unidad"] ?? "";
$cantidade = $input["centrada"] ?? "";
$observa = $input["obser"] ?? "";
$bodegae = $input["bod"] ?? "";
$nit = $input["nites"] ?? "";


if ($fecha === "" || $prefijo === "" || $csc === "" || $ref === "" || $descrip === "" || $um === "" || $cantidade === "" || $observa === "" || $bodegae === "" || $nit === "") {
    echo json_encode(["error" => "Todos los campos son obligatorios"]);
    exit;
}


$ok = $db->agregarEntrada('NULL', $fecha, $prefijo, $csc, $ref, $descrip, $um, $cantidade,'NULL', $observa, $bodegae, $nit);

if ($ok) {
        echo json_encode(["success" => true, "mensaje" => "Entrada registrada.."]);
}else {
        echo json_encode(["success" => false, "mensaje" => "Error al registrar la entrada.."]);
}


?>