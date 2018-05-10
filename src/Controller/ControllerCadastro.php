<?php
namespace Sendworks\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Sendworks\Entidades\Produto;
use Sendworks\Model\MProdutos;
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
    public function cadastro() {
        // validação
       
        
        $descricao = $this->contexto->get('descricao');
        $preco = $this->contexto->get('preco');
        // depois de validado
        $produto = new Produto($descricao, $preco);
        $modeloProduto = new MProdutos();
        if ($id = $modeloProduto->cadastrar($produto))
            echo ("Produto $id inserido com sucesso");
        else 
            echo "erro na inserção";
         
        
    }
}