<?php


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rota = new Route('/esporte', array('_controller' => 'ControllerEsporte','method'=> 'msgInicial'));
$rotas = new RouteCollection();
$rotas->add('teste', $rota);

return $rotas;