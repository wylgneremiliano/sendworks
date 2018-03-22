<?php

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rota = new Route('/esporte', array('_controller' => 'ControladorEsporte'));
$rotas = new RouteCollection();
$rotas->add('teste', $rota);

$contexto = new RequestContext();
$contexto->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($rotas, $contexto);