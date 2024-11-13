<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/CategoriaDAO.php";

if(isset($_POST["btn_gravar"])){
    $nome = $_POST["nome"];

    $objdao= new CategoriaDAO();
    $ret =$objdao-> CadastrarCategoria($nome);
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
                        <h2><strong>Nova categoria</strong></h2>
                        <h5>Aqui, você tem a possibilidade de criar categorias personalizadas para seus dados financeiros.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                <div class="form-group">
                    <label>Nome da categoria:</label>
                    <input id="nome" class="form-control" placeholder="Informe a categoria desejada: (Exemplo: Conta de luz)" name="nome" maxlength="35" />
                </div>
                <button type="submit" onclick="return ValidarCategoria()" name="btn_gravar" class="btn btn-success">Salvar </button> 
                <a href="consultar_categoria.php" class="btn btn-info">Consultar categorias</a>
                </form>
                <hr>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>
</html>