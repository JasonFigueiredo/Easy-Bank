<?php
require_once "../DAO/UtilDAO.php";

if (isset($_GET["close"]) && $_GET['close'] == "1") {
    UtilDAO::Deslogar();
}
?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="inicial.php"><img src="./assets/img/home.png" width=40 height=40> Página inicial </a>
            </li>
            <li>
                <a href="meus_dados.php"><img src="./assets/img/user.png" width=40 height=40> Meus dados</a>
            </li>
            <li>
                <a href="#"><img src="./assets/img/menu.png" width=35 height=35> Categorias <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php"><img src="./assets/img/post.png" width=20 height=20> Nova categoria</a>
                    </li>
                    <li>
                        <a href="consultar_categoria.php"><img src="./assets/img/search1.png" width=20 height=20=> Consultar categoria</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><img src="./assets/img/office-building.png" width=40 height=40> Empresa <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php"> <img src="./assets/img/post.png" width=20 height=20> Nova empresa </a>
                    </li>
                    <li>
                        <a href="consultar_empresa.php"><img src="./assets/img/search1.png" width=20 height=20> Consultar empresa</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><img src="./assets/img/bank.png" width=40 height=40> Contas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_conta.php"> <img src="./assets/img/post.png" width=20 height=20> Nova conta</a>
                    </li>
                    <li>
                        <a href="consultar_conta.php"><img src="./assets/img/search1.png" width=20 height=20> Consultar conta</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><img src="./assets/img/transfer.png" width=40 height=40> Movimento<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="realizar_movimento.php"><img src="./assets/img/exchange.png" width=20 height=20> Realizar movimento</a>
                    </li>
                    <li>
                        <a href="consultar_movimento.php"><img src="./assets/img/search1.png" width=20 height=20> Consultar movimento</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="_menu.php?close=1"><img src="./assets/img/exit.png" width=40 height=40> Sair</a>
            </li>
        </ul>
    </div>
</nav>