<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/MovimentoDAO.php";

$tipo = "";
$dt_inicial = "";
$dt_final = "";

if (isset($_POST["btn_pesquisar"])) {
    $tipo = $_POST["tipo"];
    $dt_inicial = $_POST["data_inicial"];
    $dt_final = $_POST["data_final"];

    $dao = new MovimentoDAO();
    $movs = $dao->FiltrarMovimento($tipo, $dt_inicial, $dt_final);

    if (!is_array($movs)) {
        $ret = FLAG_VAZIO;
    } else if (count($movs) == 0) {
        $ret = FLAG_MOVIMENTACAO;
    }
} else if (isset($_POST["btn_excluir"])) {
    $id_movimento = $_POST["idMov"];
    $id_conta = $_POST["idConta"];
    $tipo_movimento = $_POST["tipo"];
    $valor = $_POST["valor"];
    $dao = new MovimentoDAO();
    $ret = $dao->ExcluirMovimento($id_movimento, $id_conta, $valor, $tipo_movimento);
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
                        <h2><strong>Consultar movimento</strong></h2>
                        <h5>Consulte todos os movimentos em um determinado periodo.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <form action="consultar_movimento.php" method="post">
                    <hr />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo de movimento:</label>
                            <select class="form-control" name="tipo">
                                <!-- usar o IF ternario é um if e else na mesma linha "? = entao" ": caso contrario" -->
                                <option value="0" <?= $tipo == "0" ? "selected" : "" ?>>Todos</option>
                                <option value="1" <?= $tipo == "1" ? "selected" : "" ?>>Entrada</option>
                                <option value="2" <?= $tipo == "2" ? "selected" : "" ?>>Saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data inicial<span style="color: #d80000;">*</span>:</label>
                            <input type="date" class="form-control" name="data_inicial" id="datainicialconsulta" value="<?= $dt_inicial ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data final<span style="color: #d80000;">*</span>:</label>
                            <input type="date" class="form-control" name="data_final" id="datafinalconsulta" value="<?= $dt_final ?>" />
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-info" onclick="return ValidarConsulta()" name="btn_pesquisar">Pesquisar</button>
                        <hr>
                    </center>
                </form>

                <?php if (isset($movs) && is_array($movs) && count($movs) > 0) { ?>
                    <!-- foi acrescentado uma verificação se realmenmte é um array
                     '&& is_array($movs) e uma contatagem' -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                Resultado processado com sucesso.
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data do movimento</th>
                                                    <th>Tipo</th>
                                                    <th>categoria</th>
                                                    <th>Empresa</th>
                                                    <th>conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                for ($i = 0; $i < count($movs); $i++) {
                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total += $movs[$i]['valor_movimento'];
                                                    } else {
                                                        $total -= $movs[$i]['valor_movimento'];
                                                    }
                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]["data_movimento"] ?></td>
                                                        <td><?= $movs[$i]["tipo_movimento"] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movs[$i]["nome_categoria"] ?></td>
                                                        <td><?= $movs[$i]["nome_empresa"] ?></td>
                                                        <td><?= $movs[$i]["banco_conta"] ?> / Ag. <?= $movs[$i]["agencia_conta"] ?> - Nº <?= $movs[$i]["numero_conta"] ?></td>
                                                        <td>R$ <?= number_format($movs[$i]["valor_movimento"], 2, ",", ".");  ?></td>
                                                        <td style="word-break: break-all;"><?= $movs[$i]["obs_movimento"] ?></td>
                                                        <td>
                                                            <button type="button" data-toggle="modal" data-target="#modalExcluir<?= $i ?>" class="btn btn-danger">Excluir</button>
                                                            <form action="consultar_movimento.php" method="post">
                                                                <input type="hidden" name="idMov" value="<?= $movs[$i]["id_movimento"] ?>">
                                                                <input type="hidden" name="idConta" value="<?= $movs[$i]["id_conta"] ?>">
                                                                <input type="hidden" name="tipo" value="<?= $movs[$i]["tipo_movimento"] ?>">
                                                                <input type="hidden" name="valor" value="<?= $movs[$i]["valor_movimento"] ?>">
                                                                <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Deseja excluir a movimentação: <br><br>
                                                                                <b>Data movimentação:</b> <?= $movs[$i]["data_movimento"] ?><br>
                                                                                <b>Tipo de movimentação:</b> <?= $movs[$i]["tipo_movimento"] == 1 ? "Entrada" : "Saída" ?><br>
                                                                                <b>Categoria:</b> <?= $movs[$i]["nome_categoria"] ?><br>
                                                                                <b>Empresa:</b> <?= $movs[$i]["nome_empresa"] ?><br>
                                                                                <b>Conta:</b> <?= $movs[$i]["banco_conta"] . " / Nº Conta: " . $movs[$i]["numero_conta"] . " / Agência: Nº " . $movs[$i]["agencia_conta"] ?><br>
                                                                                <b>Valor da movimentação:</b> <?= $movs[$i]["valor_movimento"] ?><br>
                                                                                <b>Observações:</b> <?= $movs[$i]["obs_movimento"] ?><br>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger"
                                                                                    data-dismiss="modal">Cancelar</button>
                                                                                <button name="btn_excluir" type="submit"
                                                                                    class="btn btn-success">Sim</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <center class="value">
                                            <label style='color: <?= $total < 0 ? '#ef0300' : '#00db5f' ?>; '> Total de movimentação: R$
                                                <?= number_format($total, 2, ",", "."); ?> </label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
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