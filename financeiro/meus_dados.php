<?php

require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$nome = "";
$email= "";

if(isset($_POST["btn_Gravar"])){
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $objdao = new UsuarioDAO();

    $ret = $objdao->GravarMeusDados($nome,$email);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php' ;
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php' ;
        include_once '_menu.php' ;
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once "_msg.php"; ?>
                        <h2><strong>Meus dados</strong></h2>
                        <h5>Aqui voce poderá acessar e alterar seus dados.</h5>
                    </div>
                </div>
                <hr />
                <form action="meus_dados.php" method="post">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input class="form-control" placeholder="Digite o seu nome" name="nome" value="<?= $nome ?>" id="nome" />
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input class="form-control" placeholder="Digite seu e-mail" name="email" value="<?= $email ?>" id="email"
                            type="email" />
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success"
                        name="btn_Gravar"> Guardar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>