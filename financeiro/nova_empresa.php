<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";

if(isset($_POST["gravarempresa"])){
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    $objdao= new EmpresaDAO();
    $ret = $objdao-> CadastrarEmpresa($nome, $telefone, $endereco);
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
                        <?php include_once "_msg.php"?>
                        <h2><strong>Nova empresa</strong></h2>
                        <h5>Aqui voce poderá cadastrar todas as empresas.</h5>
                    </div>
                </div>
                <hr/>
                <form action="nova_empresa.php" method="post">
                    <div class="form-group">
                        <label>Nome da Empresa * :</label>
                        <input class="form-control" placeholder="Digite o nome da empresa" name="nome" id="nome" />
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" placeholder="Digite o telefone" name="telefone" />
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" placeholder="Digite o endereço da empresa" name="endereco" />
                    </div>
                    <button class="btn btn-success" onclick="return CadastrarEmpresa()" name="gravarempresa">Guardar</button>
                    <a href="consultar_empresa.php" class="btn btn-info">Consultar suas Empresas</a>
                </form>
                <hr>
            </div>
        </div>
    </div>
</body>

</html>