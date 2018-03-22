<?php

namespace Sendworks;

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


//rota apropriada -> controlador que vai interceptar a requisição


include 'rotas.php';


$response = Response::create();
$conteudo = '<h1>Vai corinthians</h1>';
$response->setContent($conteudo);
$response->send();