<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/ContaDAO.php";

$dao = new ContaDAO();


if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);
    
    if (count($dados) == 0) {
        header('location: consultar_conta.php');
        exit;
    }
} else if (isset($_POST["btn_salvar"])) {
    $idConta = $_POST['cod'];
    $banco = $_POST['nome'];
    $numero = $_POST['agencia'];
    $agencia = $_POST['conta'];
    $saldo = $_POST['saldo'];
    
    $ret = $dao->AlterarConta($idConta, $banco, $numero, $agencia, $saldo);
    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST["btn_excluir"])) {
    $idConta = $_POST['cod'];
    $ret = $dao->ExcluirConta($idConta);
    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_conta.php');
    exit;
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
                        <?php include_once "_msg.php" ?>
                        <h2><strong>Alterar contas</strong></h2>
                        <h5>Realize alterações em todos os dados cadastrais das suas contas.</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_contas.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]["id_conta"] ?>">
                    <div class="form-group">
                        <label>Nome do banco<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" placeholder="Digite o nome do banco" name="nome" id="banco" value="<?= $dados[0]['banco_conta'] ?>" maxlength="20">
                    </div>
                    <div class="form-group">
                        <label>Agência<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" placeholder="Digite a agência bancaria" name="agencia" id="agencia" value="<?= $dados[0]['agencia_conta'] ?>" oninput="contarCaracteresAgencia()">
                    </div>
                    <div class="form-group">
                        <label>Número da conta<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" placeholder="Digite o número da conta" name="conta" id="conta" value="<?= $dados[0]['numero_conta'] ?>" oninput="contarCaracteresNumeroConta()" >
                    </div>
                    <div class="form-group">
                        <label>Saldo da conta<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" placeholder="Digite o saldo da conta" name="saldo" id="saldo" value="<?= number_format($dados[0]['saldo_conta'], 2, ',', '.') ?>" oninput="contarCaracteresSaldoConta()">
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return CriarConta()" name="btn_salvar">Salvar alterações</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a conta: <strong><?= $dados[0]["banco_conta"] ?> / Agência: <?= $dados[0]["agencia_conta"] ?> - Número: <?= $dados[0]["numero_conta"] ?></strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button name="btn_excluir" type="submit" class="btn btn-success">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
<?php
include_once '_footer.php';
?>
</html>