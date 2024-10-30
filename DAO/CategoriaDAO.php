<?php
require_once "Conexao.php";
require_once "../financeiro/_constante.php";
require_once "UtilDAO.php";

class CategoriaDAO extends Conexao
{
    public function ConsultarCategoria()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT id_categoria,nome_categoria 
                            FROM tb_categoria
                            where id_usuario = ? 
                            ORDER BY nome_categoria ASC ';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function DetalharCategoria($idCategoria)
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'SELECT id_categoria,nome_categoria 
                            FROM tb_categoria
                            where id_categoria = ?
                            AND id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarCategoria($idCategoria, $nome)
    {
        if (trim($idCategoria) == "" || $nome == "") {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'UPDATE tb_categoria
                            SET nome_categoria = ?
                            WHERE id_categoria = ?
                            AND id_usuario = ?';  //AND Usado para garantir que sempre seja o mesmo ususario logado para atualizar os dados
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindvalue(1, $nome);
        $sql->bindvalue(2, $idCategoria);
        $sql->bindvalue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirCategoria($idCategoria)
    {
        if ($idCategoria == "") {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = ' DELETE FROM tb_categoria
                        WHERE id_categoria = ?
                        AND id_usuario = ? ';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -4;
        }
    }

    public function CadastrarCategoria($nome)
    {
        if (trim($nome) == "") {
            return FLAG_VAZIO;
        }
        //1 passo: criar uma variavel que recebera o obj de conexao
        $conexao = parent::retornarConexao();
        //passo 2 : criar uma variavel que recebera o texto do comando SQL que recebera execultado no DB
        $comando_sql = 'insert into tb_categoria
                        (nome_categoria, id_usuario)
                        values ( ? , ? );';
        //passo 3: criar um obj que serra config e levado no BD para ser execultado
        $sql = new PDOStatement();
        //passo 4: colocar dentro do obj sql a conexao preparada para execultar  o comando_sql
        $sql = $conexao->prepare($comando_sql);
        //passo 5: verificar se no comando_sql eu tenho? para ser configurado. se tiver, configurar os dindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try { //passo 6 : execultar no banco de dados
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
}
