<?php

class productosController{

        public function RetornarProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $jsonproductos = Producto::obtenerProducto();
            $response->getBody()->Write(json_encode($jsonpeliculas));
            return $response ->withHeader('Content-Type', 'application/json');

        }
        public function Alta($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
        

                $productos = new Producto();
                $productos->id_producto = $listaDeParametros['id'];
                $productos->nombre = $listaDeParametros['nombre'];
                $productos->descripcion = $listaDeParametros['descripcion'];
                $productos->precio = $listaDeParametros['precio'];
                $productos->imagen = $listaDeParametros['imagen'];

                Producto::CrearProductos($productos);
                $response->getBody()->write(json_encode($productos));

                return $response;
        }
        public function obtenerFormMod($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $productos = new Producto();
            $productos->id_producto = $listaDeParametros['id'];

            $jsonproductos = Producto::FormModProducto($productos);

            $response->getBody()->Write(json_encode($jsonproductos));
            return $response ->withHeader('Content-Type', 'application/json');


        }
        public function ModProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $productos = new Producto();
            $productos->nombre = $listaDeParametros['nombre'];
            $productos->descripcion = $listaDeParametros['descripcion'];
            $productos->precio = $listaDeParametros['precio'];
            $productos->imagen = $listaDeParametros['imagen'];
            
            

            Producto::ModificarProductos($productos);
            $response->getBody()->write("producto modificado");

            return $response;

        }
        public function DeleteProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $productos=  new Producto();
            $productos->id_producto =  $listaDeParametros['id'];

            Producto::EliminarProductos($productos);
            $response->getBody()->Write("producto eliminado");
            return $response;

        }


}

?>
