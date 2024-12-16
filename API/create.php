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

$objProductos->nombreProducto = $data->nombreProducto;
$objProductos->descripcion = $data->descripcion;
$objProductos->precioCompra = $data->precioCompra;
$objProductos->precioVenta = $data->precioVenta;
$objProductos->existencia = $data->existencia;

if ($objProductos->setProductos()) {
    echo 'El producto ha sido guardado.';
    echo "Código de estado de la respuesta del servidor a la petición: http_response_code(200). ";
} else {
    echo 'Error al guardar el producto.';
}
?>