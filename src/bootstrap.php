<?php

namespace Sendworks;

require __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


include 'rotas.php';
$contexto = new RequestContext();
$contexto->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($rotas, $contexto);

print_r($matcher->match($contexto->getPathInfo()));



/*

$response = Response::create();
$conteudo = '<h1>Vai corinthians</h1>';
$response->setContent($conteudo);
$response->send();
 
 */