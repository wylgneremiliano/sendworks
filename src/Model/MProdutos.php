<?php

namespace Sendworks\Model;

use Sendworks\Util\Conexao;
use Sendworks\Entidades\Produto;
use PDO;

class MProdutos {

    function __construct() {
        
    }

    function listarProdutos() {
        try {
            $sql = 'select * from produtos';
            $ps = Conexao::getInstancia()->prepare($sql);
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function cadastrar(Produto $produto) {
        try {
            $sql = 'insert into produtos (descricao, preco) values(:descricao, :preco)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':descricao', $produto->getDescricao());
            $p_sql->bindValue(':preco', $produto->getPreco());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'deu erro na conexão:' . $ex;
        }
    }

}
