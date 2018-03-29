<?php


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;


$rotas = new RouteCollection();
$rotas->add('esporte', $rota = new Route('/esporte', array('_controller' => 'Sendworks\Controller\ControllerEsporte','method'=> 'msgInicial')));

return $rotas;