<?php
require_once "../financeiro/_constante.php";
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class MovimentoDAO extends Conexao
{
    public function RealizarMovimento($movimento, $data, $valor, $obs, $categoria, $empresa, $conta)
    {
        if (trim($movimento) == "" || trim($data) == "" || trim($valor) == "" || trim($categoria) == "" || trim($empresa) == "" || trim($conta) == "") {
            return FLAG_VAZIO;
        }
        $conexao = parent::retornarConexao();
        $comando_sql = "INSERT INTO tb_movimento
                        (tipo_movimento, 
                        data_movimento, 
                        valor_movimento, 
                        obs_movimento, 
                        id_empresa, 
                        id_conta, 
                        id_categoria, 
                        id_usuario)
                        VALUES(?,?,?,?,?,?,?,?)";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $movimento);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $obs);
        $sql->bindValue(5, $empresa);
        $sql->bindValue(6, $conta);
        $sql->bindValue(7, $categoria);
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        $conexao->beginTransaction();

        try {
            // inserção na tb_movimento
            $sql->execute();

            if ($movimento == 1) {
                $comando_sql = "UPDATE tb_conta SET saldo_conta = saldo_conta + ? WHERE id_conta = ? ";
            } else if ($movimento == 2) {
                $comando_sql = "UPDATE tb_conta SET saldo_conta = saldo_conta - ? WHERE id_conta = ? ";
            }
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);


            $sql->execute();
            $conexao->commit();
            return FLAG_SUCESSO;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return FLAG_ERRO;
        }
    }

    public function FiltrarMovimento($tipo, $dt_inicial, $dt_final)
    {
        if (trim($dt_inicial) == "" || trim($dt_final) == "") {
            return FLAG_VAZIO;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = "SELECT id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento,
                            DATE_FORMAT(data_movimento, '%d/%m/%y') AS data_movimento,
                            valor_movimento,
                            nome_categoria,
                            nome_empresa,
                            banco_conta,
                            numero_conta,
                            agencia_conta,
                            obs_movimento
                        FROM tb_movimento
                        INNER JOIN tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                        INNER JOIN tb_empresa
                                on tb_empresa.id_empresa = tb_movimento.id_empresa
                        INNER JOIN tb_conta
                                on tb_conta.id_conta = tb_movimento.id_conta
                             where tb_movimento.id_usuario = ?
                               and tb_movimento.data_movimento between ? and ? ";
        if ($tipo != 0) {

            $comando_sql = $comando_sql . ' AND tipo_movimento = ? ';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dt_inicial);
        $sql->bindValue(3, $dt_final);

        if ($tipo != 0) {
            $sql->bindValue(4, $tipo);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function MostrarUltimosLancamentos()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = "SELECT id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento,
                            DATE_FORMAT(data_movimento, '%d/%m/%y') AS data_movimento,
                            valor_movimento,
                            nome_categoria,
                            nome_empresa,
                            banco_conta,
                            numero_conta,
                            agencia_conta,
                            obs_movimento
                        FROM tb_movimento
                        INNER JOIN tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                        INNER JOIN tb_empresa
                                on tb_empresa.id_empresa = tb_movimento.id_empresa
                        INNER JOIN tb_conta
                                on tb_conta.id_conta = tb_movimento.id_conta
                             where tb_movimento.id_usuario = ? 
                             ORDER BY tb_movimento.id_movimento DESC limit 10";

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
    
    public function ExcluirMovimento($id_movimento, $id_conta, $valor, $tipo_movimento)
    {
        if ($id_movimento == "" || $id_conta == "" || $valor == "" || $tipo_movimento == "") {
            return FLAG_VAZIO;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = "DELETE FROM tb_movimento WHERE id_movimento = ? ";

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id_movimento);

        $conexao->beginTransaction();
        // responsável pela transação terminar e nao deixar faltar nehum comando, se der erro ele cancela a transação
        // e é usado antes para monitorar toda a transação

        try {
            //deleta o registro
            $sql->execute();

            if ($tipo_movimento == 1) {
                $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta - ? WHERE id_conta = ? ';
            } else if ($tipo_movimento == 2) {
                $comando_sql = 'UPDATE tb_conta SET saldo_conta = saldo_conta + ? WHERE id_conta = ? ';
            }

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $id_conta);

            $sql->execute();
            $conexao->commit();
            return FLAG_SUCESSO;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return FLAG_ERRO;
        }
    }

    public function TotalEntrada()
    {

        $conexao = parent::retornarConexao();
        $comando_sql = ' SELECT sum(valor_movimento)
                            AS total
                            FROM tb_movimento
                            WHERE tipo_movimento = 1 
                            AND id_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
    
    public function TotalSaida()
    {

        $conexao = parent::retornarConexao();
        $comando_sql = ' SELECT sum(valor_movimento)
                            AS total
                            FROM tb_movimento
                            WHERE tipo_movimento = 2 
                            AND id_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
}
