<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/CategoriaDAO.php";
$dao = new CategoriaDAO();
$categorias = $dao->ConsultarCategoria();
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
                        <?php include_once "_msg.php"; ?>
                        <h2><strong>Consultar Categoria</strong></h2>
                        <h5>Aqui, você tem controle total para consultar e alterar suas categorias.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                    Categorias cadastradas. Caso deseje realizar alterações, clique no botão 'Alterar'.
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nome da Categoria</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach($categorias as $item){ ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?= $item['nome_categoria'] ?>
                                            </td>
                                            <td>
                                                <a href="alterar_categoria.php?cod=<?= $item["id_categoria"] ?>" class="btn btn-primary" class="fa fa-edit ">Alterar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>