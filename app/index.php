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
require __DIR__ . '/entidades/Usuario.php';
require __DIR__ . '/controllers/usuarioController.php';

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

$app->get('/hello/{name}', function (
    Request $request,
    Response $response,
    array $args
) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});
//ruteo frontend,grupo adentro los get con post
$app->post('/prueba[/]', \usuarioController::class . ':CrearUsuario');
$app->post('/login[/]', \usuarioController::class . ':retornarUsuario');

//$app->post('/peliculas[/]', \usuarioController::class . ':retornarUsuario');
/*$app->group('[/]', function (RouteCollectorProxy $group) {
    $app->get('[/]', \usuarioController::class . ':CrearUsuario');
    $app->get('/login[/]', \usuarioController::class . ':retornarUsuario');
});*/

$app->run();