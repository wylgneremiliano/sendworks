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
            $sql = 'select * from usuario';
            $ps = Conexao::getInstancia()->prepare($sql);
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function cadastrar(Produto $produto) {
        try {
                        
            $sql = 'insert into usuario (nome, sobrenome, username, senha) values(:nome, :sobrenome, :username, :senha)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':nome', $produto->getNome());
            $p_sql->bindValue(':sobrenome', $produto->getSobrenome());
            $p_sql->bindValue(':username', $produto->getUsername());
            $p_sql->bindValue(':senha', $produto->getSenha());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function excluir(Produto $produto) {
        try {
            $sql = 'delete usuario where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $produto->getId());
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function alterar(Produto $produto) {
        try {
            $sql = 'update usuario set nome = :nome, sobrenome = :sobrenome, username = :username, senha = :senha where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $produto->getId());
            $p_sql->bindValue(':nome', $produto->getNome());
            $p_sql->bindValue(':sobrenome', $produto->getSobrenome());
            $p_sql->bindValue(':username', $produto->getUsername());
            $p_sql->bindValue(':senha', $produto->getSenha());
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

}
