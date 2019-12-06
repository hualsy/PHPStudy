<?php
//framework/front.php
require_once __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context -> fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes,$context);

$generator = new Routing\Generator\UrlGenerator($routes,$context);
// $generator 生成器使用
//echo $generator->generate('hello',array('name'=>'Fabien'));
//          /front.php/hello/Fabien
/*echo $generator->generate(
    'hello',
    array('name' => 'Fabien'),
    UrlGeneratorInterface::ABSOLUTE_URL
);

http://127.0.0.1:4321/front.php/hello/Fabien

*/
/*$dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);

echo $dumper->dump();*/


//$response = new Response();
/*
$map = array(
    '/hello' => __DIR__ . '/../src/pages/hello.php',
    '/bye'   => __DIR__ . '/../src/pages/bye.php',
);
*/
/*
$map = [
  '/hello' => 'hello',
  '/bye' => 'bye',
];
*/

try {
   extract($matcher->match($request -> getPathInfo()),EXTR_SKIP);
   ob_start();
   include sprintf(__DIR__.'/../src/pages/%s.php',$_route);
   $response = new Response(ob_get_clean());
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('NOT FOUND',404);
} catch (Exception $e) {
    $response = new Response('An error occurred',500);
}

//if(isset($map[$path])) {
//    ob_start();
//    extract($request->query->all(),EXTR_SKIP);
//    include sprintf(__DIR__.'/../src/pages/%s.php',$map[$path]);
////    $response->setContent(ob_get_clean());
//    $response = new Response(ob_get_clean());
//} else {
//    $response = new Response('NOT FOUND',404);
//}

$response -> send();