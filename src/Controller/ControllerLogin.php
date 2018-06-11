<?php

namespace Sendworks\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sendworks\Entidades\Usuario;
use Sendworks\Model\MUsuario;
use Sendworks\Util\sessao;

class ControllerLogin {

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
        //if ($this->sessao->existe('Usuario'))
        return $this->response->setContent($this->twig->render('login.twig'));
        //else {
        //  $destino = '/login';
        //$redirecionar = new RedirectResponse($destino);
        //$redirecionar->send();
        //}
    }

    public function showLog() {
        if ($this->sessao->existe('username'))
            return $this->response->setContent($this->twig->render('index.twig'));
        else {
            $destino = '/login';
            $redirecionar = new RedirectResponse($destino);
            $redirecionar->send();
        }
    }

    public function logoff() {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        $this->sessao->del();
        print_r($_SESSION);
    }

    public function login() {
        // Constante com a quantidade de tentativas aceitas
        define('TENTATIVAS_ACEITAS', 5);

        // Constante com a quantidade minutos para bloqueio
        define('MINUTOS_BLOQUEIO', 30);
        $username = $this->contexto->get('username');
        $senha = $this->contexto->get('senha');
        echo 'teste';
        $User = new Usuario();
        $User->setUsername($username);
        $User->setSenha($senha);
        $mUser = new MUsuario();
        $result = $mUser->ler($User);

        if ($result) {
            $this->sessao->add('username', $User->getUsername());
            $this->sessao->add('senha', $User->getSenha());
            
        }

        if ($this->sessao->existe('ez')) {
            echo json_encode($_SESSION);
            exit();
        }
    }

}
