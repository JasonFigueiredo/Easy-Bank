<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/MovimentoDAO.php";
require_once "../DAO/CategoriaDAO.php";
require_once "../DAO/EmpresaDAO.php";
require_once "../DAO/ContaDAO.php";

$dao_cat = new CategoriaDAO();
$dao_emp = new EmpresaDAO();
$dao_con = new ContaDAO();

if (isset($_POST["btn_gravar"])) {
    $movimento = $_POST["movimento"];
    $data = $_POST["data"];
    $valor = $_POST["valor"];
    $obs = $_POST["obs"];
    $categoria = $_POST["categoria"];
    $empresa = $_POST["empresa"];
    $conta = $_POST["conta"];

    $objdao = new MovimentoDAO();
    $ret = $objdao->RealizarMovimento(
        $movimento,
        $data,
        $valor,
        $obs,
        $categoria,
        $empresa,
        $conta
    );
}

$categorias = $dao_cat->ConsultarCategoria();
$empresas = $dao_emp->ConsultarEmpresa();
$contas = $dao_con->ConsultarConta();


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
                        <h2><strong>Realizar movimentações</strong></h2>
                        <h5>Realize aqui todas as suas movimentações financeiras de entrada e saída.</h5>
                    </div>
                </div>
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de movimento * :</label>
                            <select id="movimento" name="movimento" class="form-control">
                                <option value="0">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data da movimentação * :</label>
                            <input id="data" name="data" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Valor da movimentação * :</label>
                            <input id="valor" name="valor" class="form-control"
                                placeholder="Digite o valor da movimentação" oninput="contarCaracteresValorMov()">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Categoria * :</label>
                            <select id="categoria" name="categoria" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $item) { ?>
                                    <option value="<?= $item["id_categoria"] ?>">
                                        <?= $item["nome_categoria"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa * :</label>
                            <select id="empresa" name="empresa" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($empresas as $item) { ?>
                                    <option value="<?= $item["id_empresa"] ?>">
                                        <?= $item["nome_empresa"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta * :</label>
                            <select id="conta" name="conta" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($contas as $item) { ?>
                                    <option value="<?= $item["id_conta"] ?>">
                                        <?= "Banco: " . $item["banco_conta"] .
                                            " / Agência: Nº" . $item["agencia_conta"] .
                                            " / " . "Nº Conta " . $item["numero_conta"] .
                                            " / Saldo: " . number_format($item["saldo_conta"], 2, ",", "."); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observações:</label>
                            <textarea maxlength="100" class="form-control" rows="1" id="obs" name="obs" placeholder="Insira observações referente a movimentação."></textarea>
                        </div>
                        <button onclick="return ValidarMovimento()" type="submit" name="btn_gravar"
                            class="btn btn-success">Finalizar movimentação</button>
                        <a href="consultar_movimento.php" class="btn btn-info">Consultar seus movimentos</a>
                    </div>
                </form>
                <hr>
                <br>
            </div>
        </div>
    </div>
</body>

</html>