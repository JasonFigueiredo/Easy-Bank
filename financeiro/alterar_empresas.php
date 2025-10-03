<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once "../DAO/EmpresaDAO.php";

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idEmpresa = $_POST['cod'];
    $nomeempresa = $_POST['nomeempresa'];
    $telefoneempresa = $_POST['telefoneempresa'];
    $enderecoempresa = $_POST['enderecoempresa'];

    $ret = $dao->AlterarEmpresa($idEmpresa, $nomeempresa, $telefoneempresa, $enderecoempresa);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->ExcluirEmpresa($idEmpresa);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
    exit;
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
                <div class="form-container alterar-empresas">
                    <div class="page-header">
                        <?php include_once "_msg.php" ?>
                        <h2><strong>Alterar empresa</strong></h2>
                        <h5>Aqui, você poderá realizar alterações nos dados cadastrais da empresa.</h5>
                    </div>
                    <div class="form-card">
                        <form action="alterar_empresas.php" method="post" class="user-form">
                            <input type="hidden" name="cod" value="<?= $dados[0]["id_empresa"] ?>">
                            
                            <div class="form-group">
                                <label for="nome">Nome da empresa <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 21H21M5 21V7L12 3L19 7V21M9 9H10M14 9H15M9 13H10M14 13H15M9 17H10M14 17H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input class="form-control" value="<?= $dados[0]["nome_empresa"] ?>" placeholder="Digite o nome da empresa" name="nomeempresa" id="nome" maxlength="45" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 16.92V19.92C22 20.52 21.52 21 20.92 21C10.93 21 3 13.07 3 3.08C3 2.48 3.48 2 4.08 2H7.08C7.68 2 8.16 2.48 8.16 3.08C8.16 4.08 8.35 5.05 8.72 5.92C8.83 6.18 8.77 6.47 8.58 6.66L7.09 8.15C8.51 10.59 10.94 13.02 13.38 14.44L14.87 12.95C15.06 12.76 15.35 12.7 15.61 12.81C16.48 13.18 17.45 13.37 18.45 13.37C19.05 13.37 19.53 13.85 19.53 14.45L19.52 17.45C19.52 18.05 19.04 18.53 18.44 18.53H17.44" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input class="form-control" value="<?= $dados[0]["telefone_empresa"] ?>" placeholder="(XX) XXXXX-XXXX" name="telefoneempresa" type="text" id="telefone" maxlength="15" oninput="aplicarMascaraTelefone(this)">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="endereco">Endereço</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10C21 17L12 23L3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 11.1046 17.8954 12 19 12C20.1046 12 21 11.1046 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <input class="form-control" value="<?= $dados[0]["endereco_empresa"] ?>" placeholder="Digite o endereço da empresa" name="enderecoempresa" maxlength="60">
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success btn-green" name="btn_salvar" onclick="return CadastrarEmpresa()">
                                    <i class="fi fi-rr-disk" style="font-size: 16px; padding-right: 8px;"></i>
                                    Salvar Alterações
                                </button>
                                <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger btn-red">
                                    <i class="fi fi-rr-trash" style="font-size: 16px; padding-right: 8px;"></i>
                                    Excluir Empresa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                
                <!-- Modal de exclusão personalizada -->
                <div id="modalExcluir" class="custom-modal">
                    <div class="modal-overlay" onclick="closeModal()"></div>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Confirmação de Exclusão</h3>
                            <button type="button" class="modal-close" onclick="closeModal()">
                                <i class="fi fi-rr-cross" style="font-size: 16px;"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-icon">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <polyline points="3,6 5,6 21,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19 6V20C19 21.1046 18.1046 22 17 22H7C5.89543 22 5 21.1046 5 20V6M8 6V4C8 2.89543 8.89543 2 10 2H14C15.1046 2 16 2.89543 16 4V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <line x1="10" y1="11" x2="10" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <line x1="14" y1="11" x2="14" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p>Deseja excluir a empresa:</p>
                            <div class="modal-company-info">
                                <strong><?= $dados[0]["nome_empresa"] ?></strong>
                                <?php if (!empty($dados[0]["telefone_empresa"])) { ?>
                                    <span class="company-detail">Telefone: <?= $dados[0]["telefone_empresa"] ?></span>
                                <?php } ?>
                                <?php if (!empty($dados[0]["endereco_empresa"])) { ?>
                                    <span class="company-detail">Endereço: <?= $dados[0]["endereco_empresa"] ?></span>
                                <?php } ?>
                            </div>
                            <p class="modal-warning">Esta ação não pode ser desfeita!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModal()">
                                <i class="fi fi-rr-cross" style="font-size: 16px; padding-right: 8px;"></i>
                                Cancelar
                            </button>
                            <form action="alterar_empresas.php" method="post" style="display: inline;">
                                <input type="hidden" name="cod" value="<?= $dados[0]["id_empresa"] ?>">
                                <button name="btn_excluir" type="submit" class="btn btn-danger btn-red">
                                    <i class="fi fi-rr-trash" style="font-size: 16px; padding-right: 8px;"></i>
                                    Confirmar Exclusão
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function openModal() {
            document.getElementById('modalExcluir').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            document.getElementById('modalExcluir').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Fechar modal com ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
        
            // Atualizar o botão de excluir para usar a nova modal
            document.addEventListener('DOMContentLoaded', function() {
                const excluirBtn = document.querySelector('button[data-target="#modalExcluir"]');
                if (excluirBtn) {
                    excluirBtn.setAttribute('onclick', 'openModal()');
                    excluirBtn.removeAttribute('data-toggle');
                    excluirBtn.removeAttribute('data-target');
                }
            });
        </script>
</body>
<?php
include_once '_footer.php';
?>

</html>