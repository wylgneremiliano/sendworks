<?php

namespace Sendworks\Controller;

use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\RequestContext;

class ControllerEsporte {

    private $response;
    private $contexto;

    public function __construct(Response $response, RequestContext $contexto) {
        $this->response = $response;
        $this->contexto = $contexto;
    }

    public function msgInicial() {
        
        return $this->response->setContent($this->contexto->getPathInfo());
    }

}
