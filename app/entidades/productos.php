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
    
    public static function CrearProductos($produ)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO  `productos`(`titulo`,`descripcion`,`puntaje`,`imagen`,`anio`,`trailer`) VALUES (?,?,?,?,?,?)");
    
   
    $consulta->execute([$produ->titulo,$produ->descripcion,$produ->puntaje,$produ->imagen,$produ->anio,$produ->trailer]);

    return;
}

 public static function EliminarProductos($produ)
{


    $objAccesoDatos = AccesoDatos::obtenerInstancia();
    $consulta = $objAccesoDatos->prepararConsulta("DELETE FROM `productos` WHERE id_producto = ?");
  
    $consulta->execute([$produ->id_producto]);

   
    return;
}
public static function FormModProducto($produ)
    {
   
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM `productos` WHERE `id_producto`= ?");

        $consulta->execute([$produ->id_producto]);

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'productos');
}
 public static function ModificarProductos($produ)
       {

            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("UPDATE `productos` SET `titulo` = ? , `descripcion` = ? , `puntaje` = ? , `imagen` = ?, `anio` = ? ,`trailer` = ?  WHERE `id_producto` = ? ");
            $consulta->execute([$produ->titulo, $produ->descripcion,$produ->puntaje, $produ->imagen, $produ->anio, $produ->trailer, $produ->id_producto]);
            return;
       }
}
?>
