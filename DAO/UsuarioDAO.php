<?php
require_once "Conexao.php";
require_once "../financeiro/_constante.php";
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao
{
    public function CarregarMeusDados($nome, $email)
    {
        if (trim($nome) == '' || trim($email) == '') {
            return FLAG_VAZIO;
        }
        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT nome_usuario,
                                       email_usuario
                                  FROM tb_usuario
                                  WHERE id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        // remove index de dentro do array , permanece somente com as colunas do Banco de Dados
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
    public function GravarMeusDados($nome, $email)
    {
        if (trim($nome) == '' || trim($email) == '') {
            return FLAG_VAZIO;
        }
        if($this->VerificarEmailDuplicadoAlteracao($email) != 0){
            return -5;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = " UPDATE tb_usuario
                                SET nome_usuario = ?,
                                    email_usuario = ?
                              WHERE id_usuario = ? ";
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    public function ValidarLogin($email, $senha)
    {
        if (trim($email) == '' || trim($senha) == '') {
            return FLAG_VAZIO;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = ' SELECT id_usuario, nome_usuario
                        FROM tb_usuario
                        WHERE email_usuario = ?
                        AND senha_usuario = ? ';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email );
        $sql->bindValue(2, $senha );

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $user = $sql->fetchAll();
        
        if(count($user)== 0){
            return -6;
        }

        $cod = $user[0]["id_usuario"];
        $nome = $user[0]['nome_usuario'];
        UtilDAO::CriarSessao($cod,$nome);
        header("location: inicial.php");
        exit;

    }
    public function VerificarEmailDuplicadoCadastro($email)
    {
        if(trim($email)==""){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = " SELECT count(email_usuario) 
                            AS contar 
                            FROM tb_usuario 
                            WHERE email_usuario = ? ";

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];
    }
    public function VerificarEmailDuplicadoAlteracao($email)
    {
        if(trim($email)==""){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = " SELECT count(email_usuario) 
                            AS contar 
                            FROM tb_usuario 
                            WHERE email_usuario = ? AND id_usuario != ? ";
    
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];
    }
    public function CriarCadastro($nome, $email, $senha1, $senha2)
    {

        if (trim($nome) == '' || trim($email) == '' || trim($senha1) == '' || trim($senha2) == '') {
            return FLAG_VAZIO;
        }

        if (strlen($senha1) < 6) {
            return FLAG_MENOR;
        }

        if (trim($senha1) != trim($senha2)) {
            return FLAG_INCORRETO;
        }

        if($this->VerificarEmailDuplicadoCadastro($email) != 0){
            return -5;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = " INSERT INTO tb_usuario
            (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                    VALUES(?,?,?,?)";

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha1);
        $sql->bindValue(4, date('Y-m-d'));

        try {
            $sql->execute();
            return FLAG_SUCESSO;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return FLAG_ERRO;
        }
    }
}
