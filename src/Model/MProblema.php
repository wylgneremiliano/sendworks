<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sendworks\Model;
use Sendworks\Util\Conexao;
use Sendworks\Entidades\Problema;
use PDO;

/**
 * Description of MProblema
 *
 * @author wylgner
 */
class MProblema {
   function __construct() {
        
    }

    function listarProblemas() {
        try {
            $sql = 'select * from problemas';
            $ps = Conexao::getInstancia()->prepare($sql);
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function cadastrar(Problema $prob) {
        try {

            $sql = 'insert into problema (titulo, entrada, saida, enunciado, id_usuario) values(:titulo, :entrada, :saida, :enunciado, :id_usuario)';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':titulo', $prob->getTitulo());
            $p_sql->bindValue(':entrada', $prob->getEntrada());
            $p_sql->bindValue(':saida', $prob->getSaida());
            $p_sql->bindValue(':enunciado', $prob->getEnunciado());
            $p_sql->bindValue(':id_usuario', $prob->getId_usuario());
            if ($p_sql->execute())
                return Conexao::getInstancia()->lastInsertId();
            return null;
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function excluir(Problema $prob) {
        try {
            $sql = 'delete problema where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $prob->getId());
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }

    function alterar(Problema $prob) {
        try {
            $sql = 'update Problema set titulo = :titulo, entrada = :entrada, saida = :saida, enunciado = :enunciado where id = :id';
            $p_sql = Conexao::getInstancia()->prepare($sql);
            $p_sql->bindValue(':id', $prob->getId());
            $p_sql->bindValue(':titulo', $prob->getTitulo());
            $p_sql->bindValue(':entrada', $prob->getEntrada());
            $p_sql->bindValue(':saida', $prob->getSaida());
            $p_sql->bindValue(':enunciado', $prob->getEnunciado());
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:' . $ex;
        }
    }


}
