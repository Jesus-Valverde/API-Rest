<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../Config/DataBase.php';
include_once '../Classes/Productos.php';

$objBaseDatos = new DataBase();
$db = $objBaseDatos->getConnection();

$objProductos = new Productos($db);

$data = json_decode(file_get_contents("php://input"));

$objProductos->idProducto = $data->idProducto;

if($objProductos->borrarProducto()) {
    echo json_encode("Producto eliminado.");
} else {
    echo json_encode("Error al eliminar el producto.");
}
?>