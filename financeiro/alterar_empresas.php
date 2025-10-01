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
    <!-- Switch de tema para dashboard -->
    <div class="theme-switch-dashboard">
        <label class="switch">
            <input checked="true" id="theme-checkbox" type="checkbox" />
            <span class="slider">
                <div class="star star_1"></div>
                <div class="star star_2"></div>
                <div class="star star_3"></div>
                <svg viewBox="0 0 16 16" class="cloud_1 cloud">
                    <path
                        transform="matrix(.77976 0 0 .78395-299.99-418.63)"
                        fill="#fff"
                        d="m391.84 540.91c-.421-.329-.949-.524-1.523-.524-1.351 0-2.451 1.084-2.485 2.435-1.395.526-2.388 1.88-2.388 3.466 0 1.874 1.385 3.423 3.182 3.667v.034h12.73v-.006c1.775-.104 3.182-1.584 3.182-3.395 0-1.747-1.309-3.186-2.994-3.379.007-.106.011-.214.011-.322 0-2.707-2.271-4.901-5.072-4.901-2.073 0-3.856 1.202-4.643 2.925"
                    ></path>
                </svg>
            </span>
        </label>
    </div>

    <div id="wrapper">
        <!-- Botão toggle do menu -->
        <button id="menu-toggle" class="menu-toggle-btn">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
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