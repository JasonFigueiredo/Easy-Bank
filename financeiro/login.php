<?php
require_once "../DAO/UsuarioDAO.php";

$objdao = new UsuarioDAO();
$email = "";
$senha = "";
if (isset($_POST["btn_entrar"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $ret = $objdao->ValidarLogin($email, $senha);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div class="banner">
        <img src="./assets/img/cinza.jpg" type="jpg">
    </div>
    <div class="container">
        <div class="row text-center ">
            <div class="titulo">
                <source media="(min-width:600px)" srcset="brasao.jpg">
                <img src="./assets/img/easybanklogo2.png" alt="EasyBanklogo">
            </div>
            <br>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="login.php" method="post">
                            <?php include_once "_msg.php" ?>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><img src="./assets/img/email.png" width=15 height=15></span>
                                <input id="email" maxlength="45" name="email" type="email" class="form-control" placeholder="Seu e-mail " value="<?= $email ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><img src="./assets/img/password.png" width=15 height=15></span>
                                <input id="senha" maxlength="12" name="senha" type="password" class="form-control" placeholder="Sua senha" value="<?= $senha ?>" />
                            </div>
                            <center>
                                Esqueçeu a sua senha?
                                <a href="redefinir_senha.php">Redefinir senha</a>
                                <br>
                                <br>
                                <button onclick="return ValidarLogin()" class="btn btn-primary" name="btn_entrar">Entrar</button>
                                <hr />Não tem cadastro ?
                                <a href="Cadastro.php">Então clique aqui</a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>