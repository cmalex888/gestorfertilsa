<?php
// ENDPOINT POST - inventarioDisponible.php 
// POST http://localhost/apis/rest/consultaMovimientosDocumentos.php

require_once "configuracion.php";

$input = json_decode(file_get_contents("php://input"), true);

$sigla = $input["prefijo"] ?? "";
$csc = $input["conse"] ?? "";


if ($sigla === "" || $csc === "") {
    echo json_encode(["error" => "Faltan datos"]);
    exit;
}


$documentoEncontrado = $db->consultarDocumentoAnulacion($sigla, $csc);

$inventarioEncontrado = $db->consultarDisponibleAnulacion();


if (!$documentoEncontrado || !$inventarioEncontrado) {
    echo json_encode([
        "success" => false,
        "mensaje" => "Faltan datos del documento o del inventario disponible."
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// 1. Indexamos y acumulamos el 'saldo' del documento por productos_referencia + bodega_codigo
$docIndexado = [];
foreach ($documentoEncontrado as $docItem) {
    $clave = $docItem['productos_referencia'] . '_' . $docItem['bodega_codigo'];
    
    if (!isset($docIndexado[$clave])) {
        $docIndexado[$clave] = 0;
    }
    $docIndexado[$clave] += (float) $docItem['saldo'];
}

$saldosNegativos = [];
$totalSaldoNegativo = 0; // Variable acumuladora
$cantidadNegativos = 0; // Variable acumuladora

// 2. Calculamos la resta, filtramos los negativos y sumamos el saldo
foreach ($inventarioEncontrado as $invItem) {
    $clave = $invItem['productos_referencia'] . '_' . $invItem['bodega_codigo'];
    
    $saldoInventario = (float) $invItem['saldo'];
    $saldoRestar = $docIndexado[$clave] ?? 0;
    $nuevoSaldo = $saldoInventario - $saldoRestar;

    if ($nuevoSaldo < 0) {
        $invItem['saldo'] = $nuevoSaldo;
        $saldosNegativos[] = $invItem;
        $totalSaldoNegativo += $nuevoSaldo; // Sumamos el saldo
        $cantidadNegativos = count($saldosNegativos); // contar negativos
    }
}

// 3. Devolvemos el JSON incluyendo el total calculado
echo json_encode([
    "success" => true,
    "mensaje" => count($saldosNegativos) > 0 
        ? "Se encontraron productos con saldo negativo." 
        : "No hay productos con saldo negativo.",
    "total_saldo" => round($totalSaldoNegativo, 2), // Total listo para usar en JS
    "total_registros" => $cantidadNegativos, //cuenta de negativos
    "inventario" => $saldosNegativos
], JSON_UNESCAPED_UNICODE);


?>