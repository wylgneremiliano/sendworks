<?php

namespace Sendworks\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Twig\Environment;

class ControllerCadastro {

    private $response;
    private $contexto;
    private $twig;

    public function __construct(Response $response, Request $contexto, Environment $twig) {
        $this->response = $response;
        $this->contexto = $contexto;
        $this->twig = $twig;
    }

    public function show() {

        return $this->response->setContent($this->twig->render('cadastro.twig'));
    }
    
    public function cadastro(){
        print_r($this->contexto);
    }

}
