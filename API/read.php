<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../Config/DataBase.php';
include_once '../Classes/Productos.php';

$objBaseDatos = new DataBase();
$db = $objBaseDatos->getConnection();

$objProductos = new Productos($db);

$stmt = $objProductos->getProductos();
$totalProductos = $stmt->rowCount();


if ($totalProductos > 0) {
    $arregloProductos = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "idProducto" => $idProducto,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "precioCompra" => $precioCompra,
            "precioVenta" => $precioVenta,
            "existencia" => $existencia
        );

        array_push($arregloProductos, $e);
    }

    echo json_encode($arregloProductos);

} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encontraron productos.")
    );
}
?>