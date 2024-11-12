<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

if(isset($_POST["btn"])){
    $banco = $_POST["banco"];
    $agencia = $_POST["agencia"];
    $numero = $_POST["numero"];
    $saldo = $_POST["saldo"];

    $objdao= new ContaDAO();
    $ret = $objdao-> CadastrarConta($banco, $agencia, $numero, $saldo);
}

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
                        <?php include_once "_msg.php"?>
                        <h2><strong>Nova Conta</strong></h2>
                        <h5>Cadastre aqui todas as suas contas para um gerenciamento centralizado.</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="nova_conta.php">
                    <div class="form-group">
                        <label>Nome do Banco * :</label>
                        <input id="banco" name="banco" class="form-control" placeholder="Digite o nome do banco" maxlength="20" />
                    </div>
                    <div class="form-group">
                        <label>Agência * :</label>
                        <input id="agencia" name="agencia" class="form-control" placeholder="Digite a agência bancaria" oninput="contarCaracteresAgencia()"  />
                    </div>
                    <div class="form-group">
                        <label>Numero da Conta * :</label>
                        <input id="conta" name="numero" class="form-control" placeholder="Digite o numero da conta" type="number" oninput="contarCaracteresNumeroConta()" />
                    </div>
                    <div class="form-group">
                        <label>Saldo da Conta * :</label>
                        <input id="saldo" name="saldo" class="form-control" placeholder="Digite o saldo da conta"  oninput="contarCaracteresSaldoConta()"/>
                    </div>
                <button onclick="return CriarConta()" class="btn btn-success" name="btn">Guardar</button>
                <a href="consultar_conta.php" class="btn btn-info">Consultar suas Contas</a>    
            </form>
                <hr>
            </div>
        </div>
    </div>
</body>
</html>