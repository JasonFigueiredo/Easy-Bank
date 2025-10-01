<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';
$dao = new ContaDAO();

$contas = $dao->ConsultarConta();

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
                        <?php include_once "_msg.php"?>
                        <h2><strong>Consultar contas</strong></h2>
                        <h5>Consulte aqui o saldo completo de todas as suas contas.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="panel panel-default">
                    <div class="panel-heading">
                    Contas cadastradas. Caso deseje realizar alterações, clique no botão 'Alterar'.
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Banco</th>
                                        <th>Agência</th>
                                        <th>Número da conta</th>
                                        <th>Saldo</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($contas as $item) {?>
                                    <tr class="odd gradeX">
                                        <td><?= $item['banco_conta'] ?></td>
                                        <td>Nº <?= $item['agencia_conta'] ?></td>
                                        <td>Nº <?= $item['numero_conta'] ?></td>
                                        <td>R$ <?= number_format($item['saldo_conta'], 2 ,",","."); ?></td>
                                        <td>
                                            <a href="alterar_contas.php?cod=<?= $item['id_conta']?>" class="btn btn-primary" class="fa fa-edit ">Alterar</a>
                                        </td>
                                    </tr>
                                    <?php }?>
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
<?php
include_once '_footer.php';
?>
</html>