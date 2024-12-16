<?php
class Productos
{
    // Conexion
    private $conn;

    // Tabla de la bd a utilizar
    private $tabla = "productos";

    // Columnas de la tabla de la base de datos
    public $idProducto;
    public $nombre;
    public $descripcion;
    public $precioCompra;
    public $precioVenta;
    public $existencia;

    // Establecer conexion con la db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método GET que devuelve todos los productos.
    public function getProductos()
    {
        $consultaSQL = "SELECT idProducto, nombre, descripcion, precioCompra, precioVenta, existencia FROM " . $this->tabla . "";
        $stmt = $this->conn->prepare($consultaSQL);
        $stmt->execute();
        return $stmt;
    }

    public function setProductos()
    {
        $consultaSQL = "INSERT INTO " . $this->tabla . " SET nombre = :nombre, descripcion = :descripcion, precioCompra = :precioCompra, precioVenta = :precioVenta, existencia = :existencia";
        $stmt = $this->conn->prepare($consultaSQL);
        // Limpiar caracteres especiales
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precioCompra = htmlspecialchars(strip_tags($this->precioCompra));
        $this->precioVenta = htmlspecialchars(strip_tags($this->precioVenta));
        $this->existencia = htmlspecialchars(strip_tags($this->existencia));
        // Enlazar los datos tabla-clase
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precioCompra", $this->precioCompra);
        $stmt->bindParam(":precioVenta", $this->precioVenta);
        $stmt->bindParam(":existencia", $this->existencia);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // Devuelve un producto buscado por idProducto
    public function getProducto()
    {
        $consultaSQL = "SELECT idProducto, nombre, descripcion, precioCompra, precioVenta, 
                        existencia FROM " . $this->tabla . " WHERE idProducto = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($consultaSQL);
        $stmt->bindParam(1, $this->idProducto);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nombre = $dataRow['nombre'];
        $this->descripcion = $dataRow['descripcion'];
        $this->precioCompra = $dataRow['precioCompra'];
        $this->precioVenta = $dataRow['precioVenta'];
        $this->existencia = $dataRow['existencia'];
    }



    // Método UPDATE para actualizar un producto
    public function updateProductos()
    {
        $consultaSQL = "UPDATE " . $this->tabla . " SET nombre = :nombre, descripcion = :descripcion, precioCompra = :precioCompra, precioVenta = :precioVenta, existencia = :existencia WHERE idProducto = :idProducto";
        $stmt = $this->conn->prepare($consultaSQL);
        // Limpiar caracteres especiales
        $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precioCompra = htmlspecialchars(strip_tags($this->precioCompra));
        $this->precioVenta = htmlspecialchars(strip_tags($this->precioVenta));
        $this->existencia = htmlspecialchars(strip_tags($this->existencia));
        // Enlazar los datos tabla-clase
        $stmt->bindParam(":idProducto", $this->idProducto);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precioCompra", $this->precioCompra);
        $stmt->bindParam(":precioVenta", $this->precioVenta);
        $stmt->bindParam(":existencia", $this->existencia);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Borrar Producto
    public function borrarProducto()
    {
        $consultaSQL = "DELETE FROM " . $this->tabla . " WHERE idProducto = ?";
        $stmt = $this->conn->prepare($consultaSQL);

        $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));
        $stmt->bindParam(1, $this->idProducto);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>