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
        return $this->response->setContent($this->twig->render('login.twig'));
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

        $this->sessao->del();
        $redirecionar = new RedirectResponse('/login');
        $redirecionar->send();
    }

    public function login() {
        // Constante com a quantidade de tentativas aceitas
        define('TENTATIVAS_ACEITAS', 5);

        // Constante com a quantidade minutos para bloqueio
        define('MINUTOS_BLOQUEIO', 30);
        $username = $this->contexto->get('username');
        $senha = $this->contexto->get('senha');
        $User = new Usuario();
        $User->setUsername($username);
        $senha += 'ERTYUI';
        $senha = md5($senha);
        $User->setSenha($senha);
        $mUser = new MUsuario();
        //$result = $mUser->ler($User);

        if ($mUser->ler($User)) {
            $t1 = $mUser->getIdUser($user);
            $this->sessao->add('username', $User->getUsername());
             $this->sessao->add('id_usuario', $t1->getId());
            // $this->sessao->add('senha', $User->getSenha());
            // echo 'logado';
            echo '<script>location.href = "logado"</script>';
//            $response = new RedirectResponse('//logado');
//            $response->send();
        } else {
            echo 'nao logado';
        }

        if ($this->sessao->existe('ez')) {
            echo json_encode($_SESSION);
            exit();
        }
    }

}
