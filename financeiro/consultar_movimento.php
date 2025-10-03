<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/MovimentoDAO.php";
date_default_timezone_set('America/Sao_Paulo');

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
        <!-- Menu Toggle Component -->
        <?php include_once '_menu-toggle.php'; ?>
        
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="form-container movimento-container consultar-movimento">
                    <div class="page-header">
                        <?php include_once "_msg.php" ?>
                        <h2><strong>Consultar movimento</strong></h2>
                        <h5>Consulte todos os movimentos em um determinado período.</h5>
                    </div>
                    <div class="form-card movimento-card">
                        <form action="consultar_movimento.php" method="post" class="user-form">
                            <div class="form-group">
                                <label for="tipo">Tipo de movimento</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <!-- usar o IF ternario é um if e else na mesma linha "? = entao" ": caso contrario" -->
                                        <option value="0" <?= $tipo == "0" ? "selected" : "" ?>>Todos</option>
                                        <option value="1" <?= $tipo == "1" ? "selected" : "" ?>>Entrada</option>
                                        <option value="2" <?= $tipo == "2" ? "selected" : "" ?>>Saída</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="datainicialconsulta">Data inicial <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <input type="date" class="form-control" name="data_inicial" id="datainicialconsulta" value="<?= $dt_inicial ?>" required />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="datafinalconsulta">Data final <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <input type="date" class="form-control" name="data_final" id="datafinalconsulta" value="<?= $dt_final ?>" required />
                                        </div>
                                        <!-- script para desabilitar dias futuros -->
                                        <script>
                                            var today = new Date();
                                            today.setDate(today.getDate() - 1);
                                            today = today.toLocaleString("en-US", { timeZone: "America/Sao_Paulo" });
                                            var date = new Date(today);
                                            document.getElementById('datainicialconsulta').max = date.toISOString().split("T")[0];
                                            document.getElementById('datafinalconsulta').max = date.toISOString().split("T")[0];
                                        </script>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button class="btn btn-info btn-green" onclick="return ValidarConsulta()" name="btn_pesquisar">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Pesquisar Movimentos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if (isset($movs) && is_array($movs) && count($movs) > 0) { ?>
                    <!-- foi acrescentado uma verificação se realmenmte é um array
                     '&& is_array($movs) e uma contatagem' -->
                    <div class="table-container">
                        <div class="table-panel">
                            <div class="table-header">
                                Resultado processado com sucesso
                            </div>
                            <div class="table-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Data do movimento</th>
                                                <th>Tipo</th>
                                                <th>Categoria</th>
                                                <th>Empresa</th>
                                                <th>Conta</th>
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
                                                    <td>
                                                        <?php if ($movs[$i]["tipo_movimento"] == 1) { ?>
                                                            <div class="arrow-container">
                                                                <svg viewBox="0 0 24 24" fill="none" style="color: #00db5f;">
                                                                    <path d="M12 19V5M5 12L12 5L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                                <span>Entrada</span>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="arrow-container">
                                                                <svg viewBox="0 0 24 24" fill="none" style="color: #ff0000;">
                                                                    <path d="M12 5V19M19 12L12 19L5 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                                <span>Saída</span>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $movs[$i]["nome_categoria"] ?></td>
                                                    <td><?= $movs[$i]["nome_empresa"] ?></td>
                                                    <td><?= $movs[$i]["banco_conta"] ?> / Ag. <?= $movs[$i]["agencia_conta"] ?> - Nº <?= $movs[$i]["numero_conta"] ?></td>
                                                    <td>
                                                        <?php if ($movs[$i]["tipo_movimento"] == 1) { ?>
                                                            <span class="value-positive">+R$ <?= number_format($movs[$i]["valor_movimento"], 2, ",", "."); ?></span>
                                                        <?php } else { ?>
                                                            <span class="value-negative">-R$ <?= number_format($movs[$i]["valor_movimento"], 2, ",", "."); ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="word-break: break-all;"><?= $movs[$i]["obs_movimento"] ?></td>
                                                    <td>
                                                        <button type="button" data-toggle="modal" data-target="#modalExcluir<?= $i ?>" class="btn btn-danger btn-sm btn-red">
                                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <polyline points="3,6 5,6 21,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M19 6V20C19 21.1046 18.1046 22 17 22H7C5.89543 22 5 21.1046 5 20V6M8 6V4C8 2.89543 8.89543 2 10 2H14C15.1046 2 16 2.89543 16 4V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <line x1="10" y1="11" x2="10" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <line x1="14" y1="11" x2="14" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                            Excluir
                                                        </button>
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
                                                                                    class="btn btn-success btn-green">Sim</button>
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
                                        <center class="value">
                                            <label style='color: <?= $total < 0 ? '#ef0300' : '#00db5f' ?>; '> Total de movimentação: R$
                                                <?= number_format($total, 2, ",", "."); ?> </label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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