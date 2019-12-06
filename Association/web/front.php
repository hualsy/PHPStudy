<?php
// Association/web/front.php
/**
 * Created by PhpStorm
 * User : liubin
 * Date : 2019/12/6 0006
 * Time : 13:56
 */
 require_once __DIR__."/../vendor/autoload.php";

 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing;
 use Symfony\Component\HttpKernel\Controller;

 $request = Request::createFromGlobals();
 $routes = include_once __DIR__.'/../src/app.php';

 $context = new Routing\RequestContext();
 $matcher = new Routing\Matcher\UrlMatcher($routes,$context);

 $controllerResolver = new Controller\ControllerResolver();
 $argumentResolver = new Controller\ArgumentResolver();

 $framework = new Simplex\Framework($matcher,$controllerResolver,$argumentResolver);
 $response = $framework -> handle($request);

 $response -> send();