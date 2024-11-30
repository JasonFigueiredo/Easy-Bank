<?php

require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$nome = "";
$email = "";
$objdao = new UsuarioDAO();

if (isset($_POST["btn_Gravar"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $ret = $objdao->GravarMeusDados($nome, $email);
}

$dados = $objdao->CarregarMeusDados();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once "_msg.php"; ?>
                        <h2><strong>Meus dados</strong></h2>
                        <h5>Nesta seção, você poderá consultar e modificar seus dados pessoais.</h5>
                    </div>
                </div>
                <hr />
                <form action="meus_dados.php" method="post">
                    <div class="form-group">
                        <label>Nome<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" placeholder="Digite o seu nome" name="nome" value="<?= $dados[0]['nome_usuario'] ?>" id="nome" maxlength="45" />
                    </div>
                    <div class="form-group">
                        <label>E-mail<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" placeholder="Digite seu e-mail" name="email" value="<?= $dados[0]['email_usuario'] ?>" id="email" maxlength="45" type="email" />
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="btn_Gravar">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
    <?php
    include_once '_footer.php';
    ?>
</html>