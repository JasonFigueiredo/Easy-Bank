<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";

if (isset($_POST["gravarempresa"])) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    $objdao = new EmpresaDAO();
    $ret = $objdao->CadastrarEmpresa($nome, $telefone, $endereco);
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
                        d="m391.84 540.91c-.421-.329-.949-.524-1.523-.524-1.351 0-2.451 1.084-2.485 2.435-1.395.526-2.388 1.88-2.388 3.466 0 1.874 1.385 3.423 3.182 3.667v.034h12.73v-.006c1.775-.104 3.182-1.584 3.182-3.395 0-1.747-1.309-3.186-2.994-3.379.007-.106.011-.214.011-.322 0-2.707-2.271-4.901-5.072-4.901-2.073 0-3.856 1.202-4.643 2.925"></path>
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
                <div class="form-container nova-empresa">
                    <div class="page-header">
                        <?php include_once "_msg.php" ?>
                        <h2><strong>Cadastrar empresa</strong></h2>
                        <h5>Neste campo, por favor, registre todas as empresas de seu interesse.</h5>
                    </div>
                    <div class="form-card">
                        <form action="nova_empresa.php" method="post" class="user-form">
                            <div class="form-group">
                                <label for="nome">Nome da empresa <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 21H21M5 21V7L12 3L19 7V21M9 9H10M14 9H15M9 13H10M14 13H15M9 17H10M14 17H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <input class="form-control" placeholder="Digite o nome da empresa" name="nome" id="nome" maxlength="45" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-phone-call" style="font-size: 18px;"></i>
                                    </div>
                                    <input class="form-control" placeholder="(XX) XXXXX-XXXX" name="telefone" type="text" id="telefone" maxlength="15" oninput="aplicarMascaraTelefone(this)" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="endereco">Endereço da empresa</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-marker" style="font-size: 18px;"></i>
                                    </div>
                                    <input class="form-control" placeholder="Digite o endereço da empresa" name="endereco" maxlength="60" />
                                </div>
                            </div>

                            <div class="form-actions">
                                <button class="btn btn-success btn-green" name="gravarempresa" onclick="return CadastrarEmpresa()">
                                    <i class="fi fi-rr-disk" style="font-size: 16px; padding-right: 8px;"></i>
                                    Salvar Empresa
                                </button>
                                <a href="consultar_empresa.php" class="btn btn-info btn-blue">
                                    <i class="fi fi-rr-search" style="font-size: 16px; padding-right: 8px;"></i>
                                    Empresas Cadastradas
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
include_once '_footer.php'
?>

</html>