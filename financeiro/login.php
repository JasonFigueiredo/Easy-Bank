<?php
require_once "../DAO/UsuarioDAO.php";

$objdao = new UsuarioDAO();
$email = "";
$senha = "";
if (isset($_POST["btn_entrar"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $ret = $objdao->ValidarLogin($email, $senha);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <!-- Switch de tema -->
    <div class="theme-switch-container">
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

    <div class="login-container">
        <!-- Logo -->
        <div class="logo-section">
            <img src="./assets/img/easybanklogo2.png" alt="EasyBank Logo">
        </div>

        <!-- Card de login -->
        <div class="login-card">
            <h2 class="login-title">Entrar</h2>
            
            <form action="login.php" method="post">
                <?php include_once "_msg.php" ?>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fi fi-rr-envelope" style="font-size: 18px; color: var(--text-secondary);"></i>
                        </span>
                        <input id="email" maxlength="45" name="email" type="email" class="form-control" placeholder="Seu e-mail" value="<?= $email ?>" required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fi fi-rr-lock" style="font-size: 18px; color: var(--text-secondary);"></i>
                        </span>
                        <input id="senha" maxlength="12" name="senha" type="password" class="form-control" placeholder="Sua senha" value="<?= $senha ?>" required />
                    </div>
                </div>
                
                <button onclick="return ValidarLogin()" class="btn btn-primary btn-center" name="btn_entrar">
                    Entrar
                </button>
                
                <div class="login-links">
                    <p>Esqueceu a sua senha? <a href="redefinir_senha.php">Redefinir senha</a></p>
                    <p>Não tem cadastro? <a href="cadastro.php">Então clique aqui</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>