<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";

if (isset($_POST["gravarempresa"])) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    $objdao = new EmpresaDAO();
    $ret = $objdao->CadastrarEmpresa($nome, $telefone, $endereco);
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
                        <h2><strong>Cadastrar empresa</strong></h2>
                        <h5>Neste campo, por favor, registre todas as empresas de seu interesse.</h5>
                        <hr />
                        <form action="nova_empresa.php" method="post">
                            <div class="form-group">
                                <label>Nome da empresa<span style="color: #d80000;">*</span>:</label>
                                <input class="form-control" placeholder="Digite o nome da empresa" name="nome" id="nome" maxlength="45" />
                            </div>
                            <div class="form-group">
                                <label>Telefone:</label>
                                <input class="form-control" placeholder="Digite o telefone (DDD) Número" name="telefone" type="number" id='maxnumber' oninput="contarCaracteres()" />
                            </div>
                            <div class="form-group">
                                <label>Endereço da empresa:</label>
                                <input class="form-control" placeholder="Digite o endereço da empresa" name="endereco" maxlength="60" />
                            </div>
                            <button class="btn btn-success" name="gravarempresa" onclick="return CadastrarEmpresa()">Salvar</button>
                            <a href="consultar_empresa.php" class="btn btn-info">Empresas cadastradas</a>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
include_once '_footer.php'
?>
</html>