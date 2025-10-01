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
                        <?php include_once "_msg.php"; ?>
                        <h2><strong>Página inicial</strong></h2>
                        <h5>Aqui, você tem acesso a um resumo completo de todas as operações realizadas.</h5>
                    </div>
                </div>
                <hr>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--success-color);">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h3>R$ <?= $total_entrada[0]["total"] != "" ? number_format($total_entrada[0]['total'], 2, ",", ".") : "0" ?></h3>
                        </div>
                        <div class="panel-footer">
                            Total de entrada
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--danger-color);">
                                <path d="M12 22L2 17L12 12L22 17L12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 7L12 12L22 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h3>R$ <?= $total_saida[0]["total"] != "" ? number_format($total_saida[0]['total'], 2, ",", ".") : "0" ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Total de saída
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (count($movs) && is_array($movs) && count($movs) > 0) { ?>
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
</body>
<?php
include_once '_footer.php';
?>

</html>