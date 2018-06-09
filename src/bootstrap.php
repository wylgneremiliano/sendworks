<?php

namespace Sendworks;

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Sendworks\Util\sessao;

$sessao = new Sessao();
$sessao->start();

//$sessao->del();
include 'rotas.php';
$request = Request::createFromGlobals();
$contexto = new RequestContext();
$contexto->fromRequest($request);
$response = Response::create();
$matcher = new UrlMatcher($rotas, $contexto);
//print_r($contexto->getPathInfo());
$loader = new FilesystemLoader(__DIR__ . '/View');
$environment = new Environment($loader);
//$environment->addGlobal('session', $_SESSION);
try {
    $atributos = $matcher->match($contexto->getPathInfo());
    $controller = $atributos['_controller'];
    $method = $atributos['method'];
    if (isset($atributos['suffix']))
        $parametros = $atributos['suffix'];
    else
        $parametros = '';
    $obj = new $controller($response, $request, $environment, $sessao);
    $obj->$method($parametros);
} catch (Exception $ex) {
    $response->setContent('Not found fde', Response::HTTP_NOT_FOUND);
}
$response->send();
