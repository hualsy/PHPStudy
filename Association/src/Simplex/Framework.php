<?php
// Association/src/Simplex/Framework.php
/**
 * Created by PhpStorm
 * User : liubin
 * Date : 2019/12/6 0006
 * Time : 13:24
 */

namespace Simplex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Framework
{
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this -> matcher = $matcher;
        $this -> argumentResolver = $argumentResolver;
        $this -> controllerResolver = $controllerResolver;
    }

    public function handle(Request $request)
    {
        $this -> matcher ->getContext() ->fromRequest($request);
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller,$arguments);
        } catch (ResourceNotFoundException $exception){
            return new Response('Not Found', 404);
        }catch (\Exception $exception){
            return new Response('An error occurred', 500);
        }
    }
}