<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
?>
<nav class="navbar navbar-default navbar-cls-top" role="navigation">
    <div class="navbar-header">
        <div class="navbar-brand">
            <img src="./assets/img/easybanklogo2.png" alt="EasyBank Logo" class="navbar-logo">
        </div>
        <div class="navbar-user-info">
            <span class="user-greeting">Olá, <?= UtilDAO::NomeLogado() ?></span>
        </div>
    </div>
</nav>