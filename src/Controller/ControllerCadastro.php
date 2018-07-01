<?php

namespace Sendworks\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sendworks\Entidades\Usuario;
use Sendworks\Model\MUsuario;
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
        //if (!$this->sessao->existe('Usuario'))
        return $this->response->setContent($this->twig->render('cadastro.twig'));
        // else {
        //     $destino = '/login';
        //    $redirecionar = new RedirectResponse($destino);
        //    $redirecionar->send();
        // }
    }

    public function login() {
        return $this->response->setContent($this->twig->render('login.twig'));
    }

    public function ok() {
        return $this->response->setContent($this->twig->render('CadastroEfetuado.twig'));
    }

    public function cadastro() {
        //$cl = new ControllerLogin();
        // $cl->verifica();

        $nome = $this->contexto->get('nome');
        $sobrenome = $this->contexto->get('sobrenome');
        $username = $this->contexto->get('username');
        $senha = $this->contexto->get('senha');
        $senha2 = $this->contexto->get('confirmarsenha');
        
        
        if ($senha == $senha2) {
            $user = new Usuario();
            $user->setNome($nome);
            $user->setSobrenome($sobrenome);
            $user->setUsername($username);
            $senha += 'ERTYUI';
            $senha = md5($senha);
            $user->setSenha($senha);
            $modeloUser = new MUsuario();

            if ($modeloUser->cadastrar($user)) {
                echo '<script>location.href = "/login"</script>';
            }
        } else {
           echo '<script>alert("Senhas não estão iguais!");</script>';
        }

        // depois de validado
    }

}
