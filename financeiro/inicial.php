<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';

$dao = new MovimentoDAO();
$total_entrada = $dao->TotalEntrada();
$total_saida = $dao->TotalSaida();
$movs = $dao->MostrarUltimosLancamentos();
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
                        <h2><strong>Página inicial</strong></h2>
                        <h5>Aqui, você tem acesso a um resumo completo de todas as operações realizadas.</h5>
                    </div>
                </div>
                <hr>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <img src="./assets/img/money_in.png" width=80 height=80>
                            <h3>R$ <?= $total_entrada[0]["total"] != "" ? number_format($total_entrada[0]['total'], 2, ",", ".") : "0" ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            Total de entrada

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <img src="./assets/img/money_out.png" width=80 height=80>
                            <h3>R$ <?= $total_saida[0]["total"] != "" ? number_format($total_saida[0]['total'], 2, ",", ".") : "0" ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Total de saída

                        </div>
                    </div>
                </div>
                <hr>
                <?php if (count($movs) && is_array($movs) && count($movs) > 0) { ?>
                    <!-- foi acrescentado uma verificação se realmenmte é um array
                     '&& is_array($movs) e uma contatagem' -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Últimos 10 lançamentos de movimento
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data do movimento</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // laço de repetição for alterado por esse abaixo: "laço a ser utilizado e o do comentario abaixo"
                                                $total = 0;
                                                for ($i = 0; $i < count($movs); $i++) {
                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total += $movs[$i]['valor_movimento'];
                                                    } else {
                                                        $total -= $movs[$i]['valor_movimento'];
                                                    }
                                                    // $total = 0;
                                                    // for ($i = 0; $i < count($movs); $i++) {
                                                    //     if ($movs[$i]['tipo_movimento'] == 1) {
                                                    //       $total = $total + $movs[$i]['valor_movimento'];
                                                    //     } else {
                                                    //       $total = $total - $movs[$i]['valor_movimento'];
                                                    //     }

                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]["data_movimento"] ?></td>
                                                        <td><?= $movs[$i]["tipo_movimento"] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movs[$i]["nome_categoria"] ?></td>
                                                        <td><?= $movs[$i]["nome_empresa"] ?></td>
                                                        <td><?= $movs[$i]["banco_conta"] ?> / Ag. <?= $movs[$i]["agencia_conta"] ?> - Nº <?= $movs[$i]["numero_conta"] ?></td>
                                                        <td>R$ <?= number_format($movs[$i]["valor_movimento"], 2, ",", ".");  ?></td>
                                                        <td style="word-break: break-all;"><?= $movs[$i]["obs_movimento"] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <center class="value">
                                            <label style='color: <?= $total < 0 ? '#ff0000' : '#00db5f' ?>; '> Montante total movimentado: R$
                                                <?= number_format($total, 2, ",", "."); ?> </label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info col-md-12">
                        <b>Não há dados registrados:</b> Você ainda não realizou nenhuma transação, pagamento ou outro tipo de movimentação financeira na sua conta.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</body>
<?php
include_once '_footer.php';
?>
</html>