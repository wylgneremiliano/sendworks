<?php

namespace Sendworks\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sendworks\Entidades\Produto;
use Sendworks\Model\MProdutos;
use Sendworks\Util\sessao;

class ControllerCadastro {

    private $response;
    private $contexto;
    private $twig;
    private $sessao;

    public function __construct(Response $response, Request $contexto, Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->contexto = $contexto;
        $this->twig = $twig;
        $this->sessao = $sessao;
    }

    public function show() {
        if ($this->sessao->existe('Usuario'))
            return $this->response->setContent($this->twig->render('cadastro.twig'));
        else {
            $destino = '/login';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }

    public function login() {
        return $this->response->setContent($this->twig->render('login.twig'));
    }

    public function cadastro() {
        // validação


        $nome = $this->contexto->get('nome');
        $sobrenome = $this->contexto->get('sobrenome');
        $username = $this->contexto->get('username');
        $t1 = $this->contexto->get('senha');
        $senha = sha1($t1 . substr($sobrenome, -5));

        // depois de validado
        $produto = new Produto($nome, $sobrenome, $username, $senha);
        $modeloProduto = new MProdutos();

        $modeloProduto->cadastrar($produto);
    }

}
