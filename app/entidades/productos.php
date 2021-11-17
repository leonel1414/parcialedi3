<?php   

    class Productos{
  
        //atributos
        public $titulo;
        public $pathImagen;
        public $descripcion;

        public static function obtenerProducto()
        {
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM `productos`");
            $consulta->execute();

            
            return $consulta->fetchAll(PDO::FETCH_CLASS, 'productos');
            
        
        }
    
    public static function CrearProductos($productos)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO  `productos`(`titulo`,`descripcion`,`puntaje`,`imagen`,`anio`,`trailer`) VALUES (?,?,?,?,?,?)");
    
   
    $consulta->execute([$productos->titulo,$productos->descripcion,$productos->puntaje,$productos->imagen,$productos->anio,$productos->trailer]);

    return;
}

 public static function EliminarProductos($productos)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("DELETE FROM `productos` WHERE id_producto = ?");
  
    $consulta->execute([$productos->id_producto]);

   
    return;
}
public static function FormModProducto($productos)
    {
   
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM `productos` WHERE `id_producto`= ?");

        $consulta->execute([$productos->id_producto]);

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'productos');
}
 public static function ModificarProductos($productos)
       {

            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE `productos` SET `titulo` = ? , `descripcion` = ? , `puntaje` = ? , `imagen` = ?, `anio` = ? ,`trailer` = ?  WHERE `id_producto` = ? ");
            $consulta->execute([$productos->titulo, $productos->descripcion,$productos->puntaje, $productos->imagen, $productos->anio, $productos->trailer, $productos->id_producto]);
            return;
       }
}
?>
