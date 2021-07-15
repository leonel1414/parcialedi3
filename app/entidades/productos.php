<?php   

    class Producto{
  
        //atributos
        public $titulo;
        public $pathImagen;
        public $descripcion;

        public static function obtenerProducto()
        {
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM 'productos'");
            $consulta->execute();

            
            return $consulta->fetchAll(PDO::FETCH_CLASS, 'productos');
            
        
        }
    
    public static function CrearProductos($productos)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO `productos`(`nombre`,`descripcion`,`precio`,`imagen`) VALUES (?,?,?,?)");
    
   
    $consulta->execute([$productos->nombre,$productos->descripcion,$productos->precio,$productos->imagen]);

    return;
}

 public static function EliminarProductos($productos)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("DELETE FROM `productos` WHERE id_producto = ? ");
  
    $consulta->execute([$productos->id_producto]);

   
    return;
}
public static function FormModProducto($productos)
    {
   
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta('SELECT * FROM `productos` WHERE `id_producto`= ?');

        $consulta->execute([$productos->id_producto]);

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'productos');
}
 public static function ModificarProductos($productos)
       {

            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE `productos` SET `nombre` = ? , `descripcion` = ? , `precio` = ? , `imagen` = ? WHERE `id_producto` = ? ");
            $consulta->execute([$productos->nombre, $productos->descripcion,$productos->precio, $productos->imagen]);
            return;
       }
}
?>