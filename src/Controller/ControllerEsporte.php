<?php

namespace Sendworks\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Sendworks\Model\MProdutos;
use Twig\Environment;

class ControllerEsporte {

    private $response;
    private $contexto;
    private $twig;
    public function __construct(Response $response, RequestContext $contexto, Environment $twig) {
        $this->response = $response;
        $this->contexto = $contexto;
        $this->twig = $twig;
    }

    public function twigAqui($parametro) {

        if (!is_numeric($parametro) && $parametro != '') {
            $parametro = 'não localizado';
        }


//criar um objeto do tipo entidade // buscar os dados no banco  de dado 
             
       return $this->response->setContent($this->twig->render('master.twig'));

    }

    public function listaProdutos() {
        $modelo = new MProdutos();
        $dados = $modelo->listarProdutos();
        return $this->response->setContent($this->twig->render('produtos.twig'));
    }

}
