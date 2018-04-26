<?php
namespace Sendworks\Model;
use Sendworks\Util\Conexao;
use PDO;
class MProdutos {
    
    function __construct() {
        
    }
    function listarProdutos(){
        try{
            $sql = 'select * from produtos';
            $ps = Conexao::getInstancia()->prepare($sql);
            $ps->execute();
            return $ps->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            return 'Erro na conexão:'. $ex;
        }
    
       
    }
    
}
