<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idEmpresa = $_POST['cod'];
    $nomeempresa = $_POST['nomeempresa'];
    $telefoneempresa = $_POST['telefoneempresa'];
    $enderecoempresa = $_POST['enderecoempresa'];

    $ret = $dao->AlterarEmpresa($idEmpresa, $nomeempresa, $telefoneempresa, $enderecoempresa);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->ExcluirEmpresa($idEmpresa);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
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
                        <h2><strong>Alterar empresa</strong></h2>
                        <h5>Aqui, você poderá realizar alterações nos dados cadastrais da empresa.</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_empresas.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]["id_empresa"] ?>">
                    <div class=" form-group">
                        <label>Nome da empresa<span style="color: #d80000;">*</span>:</label>
                        <input class="form-control" value="<?= $dados[0]["nome_empresa"] ?>" placeholder=" Digite o nome da empresa" name="nomeempresa" id="nome" maxlength="45">
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" value="<?= $dados[0]["telefone_empresa"] ?>" placeholder=" Digite o telefone" name="telefoneempresa" type="number" id='maxnumber' oninput="contarCaracteres()">
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" value="<?= $dados[0]["endereco_empresa"] ?>" placeholder=" Digite o endereço da empresa" name="enderecoempresa" maxlength="60" >
                    </div>
                    <button type="submit" class="btn btn-success" name="btn_salvar" onclick="return CadastrarEmpresa()">Salvar alterações</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <center>
                                    <h4 class="modal-title" id="myModalLabel">Confirma a exclusão dos dados?</h4>
                                    </center>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a empresa: <strong><?= $dados[0]["nome_empresa"] ?></strong> ?
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