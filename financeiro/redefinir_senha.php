<?php
require_once "../DAO/UsuarioDAO.php";
$email = "";
$senha_atual = "";
$rsenha1 = "";
$rsenha2 = "";

if (isset($_POST["btn_enviar"])) {
    $email = $_POST["email"];
    $senha_atual = $_POST["senha_atual"];
    $rsenha1 = $_POST["rsenha1"];
    $rsenha2 = $_POST["rsenha2"];

    $objdao = new UsuarioDao();
    $ret = $objdao->RedefinirSenha($email, $senha_atual, $rsenha1, $rsenha2);
    if ($ret == 1) {
        header('location: login.php?ret=' . $ret);
        exit;
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div class="banner">
    <img src="./assets/img/fundo_verde.svg" type="svg">
    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="titulo">
                    <img src="./assets/img/easybanklogo2.png" alt="EasyBanklogo">
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong> Redefinir senha do usuário </strong>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="redefinir_senha.php">
                                    <br />
                                    <?php include_once "_msg.php" ?>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><img src="./assets/img/email.png" width=15 height=15></span>
                                        <input id="email" maxlength="45" type="text" class="form-control" placeholder="Seu e-mail" name="email" value="<?= $email ?>"/>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><img src="./assets/img/password.png" width=15 height=15></span>
                                        <input id="senha_atual" maxlength="12" type="password" class="form-control" placeholder="Sua senha atual" name="senha_atual" value="<?= $senha_atual ?>"/>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><img src="./assets/img/password.png" width=15 height=15></span>
                                        <input id="rsenha1" maxlength="12" type="password" class="form-control" placeholder="Sua nova senha" name="rsenha1" value="<?= $rsenha1 ?>"/>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><img src="./assets/img/password.png" width=15 height=15></span>
                                        <input id="rsenha2" maxlength="12" type="password" class="form-control" placeholder="Repita sua nova senha" name="rsenha2" value="<?= $rsenha2 ?>"/>
                                    </div>
                                    <button class="btn btn-success " name="btn_enviar" onclick="return RedefinirSenha()">Alterar senha</button>
                                    <hr />
                                    Já possui cadastro ?
                                    <a href="login.php">Fazer login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>