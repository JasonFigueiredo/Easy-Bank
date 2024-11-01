<?php
require_once "Conexao.php";
require_once "../financeiro/_constante.php";
require_once "UtilDAO.php";

class ContaDAO extends Conexao
{
    public function CadastrarConta($banco, $agencia, $numero, $saldo)
    {
        if (trim($banco) == "" || trim($agencia) == "" || trim($numero) == "" || trim($saldo) == "") {
            return FLAG_VAZIO;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'INSERT INTO tb_conta
                        (banco_conta, 
                        agencia_conta, 
                        numero_conta, 
                        saldo_conta, 
                        id_usuario)
                        VALUES(?,?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ConsultarConta()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'SELECT id_conta,
                               banco_conta,
                               agencia_conta,
                               saldo_conta,
                               numero_conta
                        FROM tb_conta
                        WHERE id_usuario = ?
                    ORDER BY banco_conta ASC';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function DetalharConta($idConta)
    {
        if ($idConta == "") {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'SELECT id_conta,
                               banco_conta,
                               agencia_conta,
                               saldo_conta,
                               numero_conta
                        FROM tb_conta
                        WHERE id_conta = ?
                        AND id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function AlterarConta($idConta, $banco, $agencia, $numero, $saldo)
    {
        if (trim($idConta) == "" || trim($banco) == "" || trim($agencia) == "" || trim($numero) == "" || trim($saldo) == "") {
            return 0;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = 'UPDATE tb_conta 
                        SET banco_conta = ?,
                        agencia_conta = ?,
                        numero_conta = ?,
                        saldo_conta = ?
                        WHERE id_conta = ?
                        AND id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idConta);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirConta($idConta)
    // esse METODO SE CHAMA "Excluir Conta " busca somente o valor que precisa deletar por isso chama comente o $IDconta = PARAMETRO
    {
        if ($idConta == "") 
            return 0;
        
        $conexao = parent::retornarConexao();
        $comando_sql = 'DELETE FROM tb_conta
                        WHERE id_conta = ?
                        AND id_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        //  -> instanciar $conexao

        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());
        // :: dois pontos Significa valor estatico pois é o id do ususario logado nao podera ser alterado

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -4;
        }
    }
}
