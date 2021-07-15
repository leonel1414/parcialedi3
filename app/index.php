<?php
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/acessoDatos/AcessoDatos.php';
require __DIR__ . '/entidades/usuario.php';
require __DIR__ . '/controllers/usuarioController.php';
require __DIR__ . '/entidades/productos.php';
require __DIR__ . '/controllers/productosController.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// Enable CORS
$app->add(function (
    Request $request,
    RequestHandlerInterface $handler
): Response {
    // $routeContext = RouteContext::fromRequest($request);
    // $routingResults = $routeContext->getRoutingResults();
    // $methods = $routingResults->getAllowedMethods();

    $response = $handler->handle($request);

    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader(
        'Access-Control-Allow-Methods',
        'get,post'
    );
    $response = $response->withHeader(
        'Access-Control-Allow-Headers',
        $requestHeaders
    );

    // Optional: Allow Ajax CORS requests with Authorization header
    // $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});


$app->group('/Frontend', function (RouteCollectorProxy $group) {
    $group->post('/Crear', \usuarioController::class . ':CrearUsuario');
    $group->post('/Login', \usuarioController::class . ':retornarUsuario');
});

$app->get('/producto[/]', \productosController::class . ':RetornarProductos');
$app->post('/altaproducto[/]', \productosController::class . ':Alta');
$app->post('/eliminarproducto[/]', \productosController::class . ':DeleteProductos');
$app->post('/FormModProducto[/]', \productosController::class . ':obtenerFormMod');
$app->post('/modificarproducto[/]', \productosController::class . ':ModProductos');


$app->run();