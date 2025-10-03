<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

if(isset($_POST["btn"])){
    $banco = $_POST["banco"];
    $agencia = $_POST["agencia"];
    $numero = $_POST["numero"];
    $saldo = $_POST["saldo"];

    $objdao= new ContaDAO();
    $ret = $objdao-> CadastrarConta($banco, $agencia, $numero, $saldo);
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
                <div class="form-container nova-conta">
                    <div class="page-header">
                        <?php include_once "_msg.php"?>
                        <h2><strong>Nova conta</strong></h2>
                        <h5>Cadastre aqui todas as suas contas para um gerenciamento centralizado.</h5>
                    </div>
                    <div class="form-card">
                        <form method="post" action="nova_conta.php" class="user-form">
                            <div class="form-group">
                                <label for="banco">Nome do banco <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-credit-card" style="font-size: 18px;"></i>
                                    </div>
                                    <input id="banco" name="banco" class="form-control" placeholder="Digite o nome do banco" maxlength="20" required />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="agencia">Agência <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-building" style="font-size: 18px;"></i>
                                    </div>
                                    <input id="agencia" name="agencia" class="form-control" placeholder="Digite a agência bancária" oninput="contarCaracteresAgencia()" required />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="conta">Número da conta <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-hashtag" style="font-size: 18px;"></i>
                                    </div>
                                    <input id="conta" name="numero" class="form-control" placeholder="Digite o número da conta" oninput="contarCaracteresNumeroConta()" required />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="saldo">Saldo da conta <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-usd-circle" style="font-size: 18px;"></i>
                                    </div>
                                    <input id="saldo" name="saldo" class="form-control" placeholder="Digite o saldo da conta (ex: 1.500,00)" type="text" oninput="aplicarMascaraMonetaria(this)" required />
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button onclick="return CriarConta()" class="btn btn-success btn-green" name="btn">
                                    <i class="fi fi-rr-disk" style="font-size: 16px; padding-right: 8px;"></i>
                                    Salvar Conta
                                </button>
                                <a href="consultar_conta.php" class="btn btn-info btn-blue">
                                    <i class="fi fi-rr-search" style="font-size: 16px; padding-right: 8px;"></i>
                                    Consultar Contas
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