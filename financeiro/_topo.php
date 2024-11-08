<?php
    require_once '../DAO/UtilDAO.php';
?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <center>
            <div class="img2">
                <img src="./assets/img/easybanklogo2.png" width=290 height=60>
            </div>
        </center>
    </div>
    <center>
    <div style="color: #fff;
padding: 30px 50px 10px 50px;
float: right;
font-size: 16px;">Olá, <?= UtilDAO::NomeLogado(); ?>, Dúvidas Ligue para (62) 9 99369-3788 </div></center>
</nav>