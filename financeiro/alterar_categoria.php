<?php
require_once "../DAO/UtilDAO.php";
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

$objdao = new CategoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idCategoria = $_GET['cod'];
    $dados = $objdao->DetalharCategoria($idCategoria);

    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idCategoria = $_POST['cod'];
    $nome =  $_POST['nomecategoria'];
    $ret = $objdao->AlterarCategoria($idCategoria, $nome);
    
    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {
    $idCategoria = $_POST['cod'];
    $ret = $objdao->ExcluirCategoria($idCategoria);
    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_categoria.php');
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
                <div class="form-container alterar-categoria">
                    <div class="page-header">
                        <?php include_once "_msg.php" ?>
                        <h2><strong>Alterar categoria</strong></h2>
                        <h5>Aqui, você tem controle total para alterar ou excluir suas categorias.</h5>
                    </div>
                    <div class="form-card">
                        <form action="alterar_categoria.php" method="post" class="user-form">
                            <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                            
                            <div class="form-group">
                                <label for="nome">Nome da categoria <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fi fi-rr-tags" style="font-size: 18px;"></i>
                                    </div>
                                    <input name="nomecategoria" value="<?= $dados[0]['nome_categoria'] ?>" maxlength="35" class="form-control" placeholder="Digite o nome da categoria EX: Conta de luz" id="nome" required>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button name="btn_salvar" type="submit" onclick='return ValidarCategoria()' class="btn btn-success btn-green">
                                    <i class="fi fi-rr-disk" style="font-size: 16px; padding-right: 8px;"></i>
                                    Salvar Alterações
                                </button>
                                <button type="button" data-target="#modalExcluir" class="btn btn-danger btn-red">
                                    <i class="fi fi-rr-trash" style="font-size: 16px; padding-right: 8px;"></i>
                                    Excluir Categoria
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Modal de exclusão personalizada -->
                <div id="modalExcluir" class="custom-modal">
                    <div class="modal-overlay" onclick="closeModal()"></div>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Confirmação de Exclusão</h3>
                            <button type="button" class="modal-close" onclick="closeModal()">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <line x1="6" y1="6" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
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
                            <p>Deseja excluir a categoria:</p>
                            <div class="modal-company-info">
                                <strong><?= $dados[0]['nome_categoria'] ?></strong>
                            </div>
                            <p class="modal-warning">Esta ação não pode ser desfeita!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModal()">
                                Cancelar
                            </button>
                            <form action="alterar_categoria.php" method="post" style="display: inline;">
                                <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                                <button name='btn_excluir' type="submit" class="btn btn-danger btn-red">
                                    Sim
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
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