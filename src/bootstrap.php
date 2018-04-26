<?php

namespace Sendworks;

require __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

include 'rotas.php';
$contexto = new RequestContext();
$contexto->fromRequest(Request::createFromGlobals());
$response = Response::create();
$matcher = new UrlMatcher($rotas, $contexto);

$loader = new FilesystemLoader(__DIR__.'/View');
$environment = new Environment($loader);

try{
   $atributos = $matcher->match($contexto->getPathInfo());
   $controller = $atributos['_controller'];
   $method = $atributos['method'];
   $parametros = $atributos['sufix'];
   
   $obj = new $controller($response, $contexto, $environment);
   $obj->$method($parametros);
} catch (Exception $ex) {
    $response->setContent('NOT FOUND MOÇO', Response::HTTP_NOT_FOUND);
}

$response->send();
 