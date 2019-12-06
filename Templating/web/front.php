<?php
//framework/front.php
require_once __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

function render_template ($request) {
    extract($request -> attributes -> all(),EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php',$_route);

    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context -> fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes,$context);

try {
    $request -> attributes ->add($matcher -> match($request ->getPathInfo()));
    $response = call_user_func('render_template',$request);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('NOT FOUND',404);
} catch (Exception $e) {
    $response = new Response('An error occurred',500);
}

$response -> send();