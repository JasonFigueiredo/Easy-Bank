<?php

require_once "../DAO/UsuarioDAO.php";
$nome = "";
$email = "";
$senha1 = "";
$senha2 = "";

$objdao = new UsuarioDao();

if (isset($_POST["btn_enviar"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha1 = $_POST["senha1"];
    $senha2 = $_POST["senha2"];

    $ret = $objdao->CriarCadastro($nome, $email, $senha1, $senha2);
    if ($ret == 1) {
        header('location: login.php?ret=' . $ret);
        exit;
    }
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

        <!-- Card de cadastro -->
        <div class="login-card">
            <h2 class="login-title">Cadastrar</h2>
            
            <form action="cadastro.php" method="post">
                <?php include_once "_msg.php" ?>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fi fi-rr-user" style="font-size: 18px; color: var(--text-secondary);"></i>
                        </span>
                        <input id="nome" maxlength="45" type="text" class="form-control" placeholder="Seu nome" name="nome" value="<?= $nome ?>" required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fi fi-rr-envelope" style="font-size: 18px; color: var(--text-secondary);"></i>
                        </span>
                        <input id="email" maxlength="45" type="email" class="form-control" placeholder="Seu melhor e-mail" name="email" value="<?= $email ?>" required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fi fi-rr-lock" style="font-size: 18px; color: var(--text-secondary);"></i>
                        </span>
                        <input id="senha1" maxlength="12" type="password" class="form-control" placeholder="Sua senha" name="senha1" value="<?= $senha1 ?>" required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fi fi-rr-lock" style="font-size: 18px; color: var(--text-secondary);"></i>
                        </span>
                        <input id="senha2" maxlength="12" type="password" class="form-control" placeholder="Repita sua senha" name="senha2" value="<?= $senha2 ?>" required />
                    </div>
                </div>
                
                <button onclick="return ValidarCadastro()" class="btn btn-primary btn-center" name="btn_enviar">
                    Cadastrar
                </button>
                
                <div class="login-links">
                    <p>Já possui cadastro? <a href="login.php">Fazer login</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>