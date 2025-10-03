<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();
$empresas = $dao->ConsultarEmpresa();

// Função para formatar telefone para exibição
function formatarTelefone($telefone) {
    if (empty($telefone)) {
        return '';
    }
    
    // Remove tudo que não é dígito
    $telefone = preg_replace('/\D/', '', $telefone);
    
    // Aplica a máscara (XX) XXXXX-XXXX
    if (strlen($telefone) == 11) {
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
    } elseif (strlen($telefone) == 10) {
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6);
    } else {
        return $telefone; // Retorna como está se não tiver 10 ou 11 dígitos
    }
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
                <div class="page-header-container">
                    <?php include_once '_msg.php'; ?>
                    <div class="page-header-content">
                        <h2><strong>Consultar empresas</strong></h2>
                        <h5>Neste local, você encontrará todas as empresas cadastradas.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="table-container">
                    <div class="table-panel">
                        <div class="table-header">
                            Empresas cadastradas
                        </div>
                        <div class="table-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nome da empresa</th>
                                            <th>Telefone</th>
                                            <th>Endereço</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($empresas); $i++) {  ?>
                                            <tr class="odd gradeX">
                                                <td class="company-cell">
                                                    <div class="company-info">
                                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--success-color);">
                                                            <path d="M3 21H21M5 21V7L12 3L19 7V21M9 9H10M14 9H15M9 13H10M14 13H15M9 17H10M14 17H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        <span><?= $empresas[$i]['nome_empresa'] ?></span>
                                                    </div>
                                                </td>
                                                <td class="phone-cell">
                                                    <?php if (!empty($empresas[$i]['telefone_empresa'])) { ?>
                                                        <div class="phone-info">
                                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--info-color);">
                                                                <path d="M22 16.92V19.92C22 20.52 21.52 21 20.92 21C10.93 21 3 13.07 3 3.08C3 2.48 3.48 2 4.08 2H7.08C7.68 2 8.16 2.48 8.16 3.08C8.16 4.08 8.35 5.05 8.72 5.92C8.83 6.18 8.77 6.47 8.58 6.66L7.09 8.15C8.51 10.59 10.94 13.02 13.38 14.44L14.87 12.95C15.06 12.76 15.35 12.7 15.61 12.81C16.48 13.18 17.45 13.37 18.45 13.37C19.05 13.37 19.53 13.85 19.53 14.45L19.52 17.45C19.52 18.05 19.04 18.53 18.44 18.53H17.44" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                            <span><?= formatarTelefone($empresas[$i]['telefone_empresa']) ?></span>
                                                        </div>
                                                    <?php } else { ?>
                                                        <span class="no-data">-</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="address-cell">
                                                    <?php if (!empty($empresas[$i]['endereco_empresa'])) { ?>
                                                        <div class="address-info">
                                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--warning-color);">
                                                                <path d="M21 10C21 17L12 23L3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 11.1046 17.8954 12 19 12C20.1046 12 21 11.1046 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <circle cx="10" cy="10" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                            <span><?= $empresas[$i]['endereco_empresa'] ?></span>
                                                        </div>
                                                    <?php } else { ?>
                                                        <span class="no-data">-</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="action-cell">
                                                    <a href="alterar_empresas.php?cod=<?= $empresas[$i]['id_empresa'] ?>" class="btn btn-primary btn-xs btn-yellow">
                                                        <i class="fi fi-rr-edit" style="font-size: 14px; padding-right: 6px;"></i>
                                                        Alterar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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