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
                        d="m391.84 540.91c-.421-.329-.949-.524-1.523-.524-1.351 0-2.451 1.084-2.485 2.435-1.395.526-2.388 1.88-2.388 3.466 0 1.874 1.385 3.423 3.182 3.667v.034h12.73v-.006c1.775-.104 3.182-1.584 3.182-3.395 0-1.747-1.309-3.186-2.994-3.379.007-.106.011-.214.011-.322 0-2.707-2.271-4.901-5.072-4.901-2.073 0-3.856 1.202-4.643 2.925"></path>
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
                <div class="form-container movimento-container realizar-movimento">
                    <div class="page-header">
                        <?php include_once "_msg.php" ?>
                        <h2><strong>Realizar movimentações</strong></h2>
                        <h5>Realize aqui todas as suas movimentações financeiras de entrada e saída.</h5>
                    </div>
                    <div class="form-card movimento-card">
                        <form action="realizar_movimento.php" method="post" class="user-form">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="movimento">Tipo de movimento <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <select id="movimento" name="movimento" class="form-control" required>
                                                <option value="0">Selecione</option>
                                                <option value="1">Entrada</option>
                                                <option value="2">Saída</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="data">Data da movimentação <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <input id="data" name="data" type="date" class="form-control" required>
                                            <!-- comando em php para validar o dia atual do computador com o fuso horario de são paulo -->
                                            <?php
                                            date_default_timezone_set('America/Sao_Paulo');
                                            $current_date = date('Y-m-d');
                                            ?>
                                            <script>
                                                document.getElementById('data').value = '<?= $current_date ?>';
                                            </script>
                                        </div>
                                        <script>
                                            document.getElementById('data').setAttribute('max', '<?= $current_date ?>');
                                            document.getElementById('data').setAttribute('min', '<?= $current_date ?>');
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <label for="valor">Valor da movimentação <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <line x1="12" y1="1" x2="12" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M17 5H9.5C8.11929 5 7 6.11929 7 7.5C7 8.88071 8.11929 10 9.5 10H14.5C15.8807 10 17 11.1193 17 12.5C17 13.8807 15.8807 15 14.5 15H7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <input id="valor" name="valor" class="form-control" placeholder="Digite o valor da movimentação (ex: 1.500,00)" type="text" oninput="aplicarMascaraMonetaria(this)" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-col">
                                    <div class="form-group">
                                        <label for="categoria">Categoria <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <select id="categoria" name="categoria" class="form-control" required>
                                                <option value="">Selecione</option>
                                                <?php foreach ($categorias as $item) { ?>
                                                    <option value="<?= $item["id_categoria"] ?>">
                                                        <?= $item["nome_categoria"] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empresa">Empresa <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 21H21M5 21V7L12 3L19 7V21M9 9H10M14 9H15M9 13H10M14 13H15M9 17H10M14 17H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <select id="empresa" name="empresa" class="form-control" required>
                                                <option value="">Selecione</option>
                                                <?php foreach ($empresas as $item) { ?>
                                                    <option value="<?= $item["id_empresa"] ?>">
                                                        <?= $item["nome_empresa"] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="conta">Conta <span class="required">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <select id="conta" name="conta" class="form-control" required>
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
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="obs">Observações</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <textarea maxlength="100" class="form-control" rows="3" id="obs" name="obs" placeholder="Insira observações referente a movimentação."></textarea>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button onclick="return ValidarMovimento()" type="submit" name="btn_gravar" class="btn btn-success">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H16L21 8V19C21 20.1046 20.1046 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <polyline points="17,21 17,13 7,13 7,21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <polyline points="7,3 7,8 15,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Finalizar Movimentação
                                </button>
                                <a href="consultar_movimento.php" class="btn btn-info">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Consultar Movimentos
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include_once '_footer.php';
?>

</html>