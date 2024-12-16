<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../Configuracion/DataBase.php";
include_once "../Clases/Productos.php";

$objBaseDatos = new DataBase();
$db = $objBaseDatos->getConnection();
$objProductos = new Productos($db);
$objProductos->idProducto = isset($_GET['idProductos']) ? $_GET['idProductos'] : die();
$objProductos->getProducto();

if($objProductos->nombre != null){

    $emp_arr = array(
        "idProductos"    => $objProductos->idProducto,
        "nombre"        => $objProductos->nombre,
        "descripcion"   => $objProductos->descripcion,
        "precioCompra"  => $objProductos->precioCompra,
        "precioVenta"   => $objProductos->precioVenta,
        "existencia"    => $objProductos->existencia
    );

    http_response_code(200);
    echo json_encode($emp_arr);
}
else{
    http_response_code(404);
    echo json_encode("Producto no encontrado...");
}
?>