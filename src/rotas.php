<?php


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;


$rotas = new RouteCollection();
$rotas->add('esporte', $rota = new Route('/esporte/{sufix}', 
        array('_controller' => 'Sendworks\Controller\ControllerEsporte','method'=> 'msgInicial'), 
        array('sufix'=>'', 'sufix' => '.*')));

return $rotas;