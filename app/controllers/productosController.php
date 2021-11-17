<?php

class productosController{

        public function RetornarProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $jsonproductos = Productos::obtenerProducto();
            $response->getBody()->Write(json_encode($jsonproductos));
            return $response ->withHeader('Content-Type', 'application/json');

        }
        public function Alta($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
        

                $productos = new Productos();
                $productos->id_producto = $listaDeParametros['id_producto'];
                $productos->nombre = $listaDeParametros['titulo'];
                $productos->descripcion = $listaDeParametros['descripcion'];
                $productos->precio = $listaDeParametros['puntaje'];
                $productos->imagen = $listaDeParametros['imagen'];
                $productos->anio = $listaDeParametros['anio'];
                $productos->trailer = $listaDeParametros['trailer'];
               
                

                Producto::CrearProductos($productos);
                $response->getBody()->write(json_encode($productos));

                return $response;
        }
        public function obtenerFormMod($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $productos = new Productos();
            $productos->id_producto = $listaDeParametros['id_producto'];

            $jsonproductos = Producto::FormModProducto($productos);

            $response->getBody()->Write(json_encode($jsonproductos));
            return $response ->withHeader('Content-Type', 'application/json');


        }
        public function ModProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $productos = new Productos();
                $productos->nombre = $listaDeParametros['titulo'];
                $productos->descripcion = $listaDeParametros['descripcion'];
                $productos->precio = $listaDeParametros['puntaje'];
                $productos->imagen = $listaDeParametros['imagen'];
                $productos->anio = $listaDeParametros['anio'];
                $productos->trailer = $listaDeParametros['trailer'];
                $productos->id_producto = $listaDeParametros['id_producto'];
            
            

            Producto::ModificarProductos($productos);
            $response->getBody()->write("Juego modificado");

            return $response;

        }
        public function DeleteProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $productos=  new Productos();
            $productos->id_producto =  $listaDeParametros['id_producto'];

            Producto::EliminarProductos($productos);
            $response->getBody()->Write("Juego eliminado");
            return $response;

        }


}

?>
