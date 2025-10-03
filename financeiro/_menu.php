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
                <a href="inicial.php">
                    <i class="fi fi-rr-home" style="font-size: 20px; padding-right: 10px;"></i>
                    Página inicial
                </a>
            </li>
            <li>
                <a href="meus_dados.php">
                    <i class="fi fi-rr-user" style="font-size: 20px; padding-right: 10px;"></i>
                    Meus dados
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fi fi-rr-tags" style="font-size: 20px; padding-right: 10px;"></i>
                    Categorias
                    <i class="fi fi-rr-angle-small-right dropdown-arrow" style="font-size: 16px;"></i>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php">
                            <i class="fi fi-rr-plus" style="font-size: 18px; padding-right: 10px;"></i>
                            Nova categoria
                        </a>
                    </li>
                    <li>
                        <a href="consultar_categoria.php">
                            <i class="fi fi-rr-search" style="font-size: 18px; padding-right: 10px;"></i>
                            Consultar categoria
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fi fi-rr-building" style="font-size: 20px; padding-right: 10px;"></i>
                    Empresa
                    <i class="fi fi-rr-angle-small-right dropdown-arrow" style="font-size: 16px;"></i>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php">
                            <i class="fi fi-rr-plus" style="font-size: 18px; padding-right: 10px;"></i>
                            Nova empresa
                        </a>
                    </li>
                    <li>
                        <a href="consultar_empresa.php">
                            <i class="fi fi-rr-search" style="font-size: 18px; padding-right: 10px;"></i>
                            Consultar empresa
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fi fi-rr-credit-card" style="font-size: 20px; padding-right: 10px;"></i>
                    Contas
                    <i class="fi fi-rr-angle-small-right dropdown-arrow" style="font-size: 16px;"></i>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_conta.php">
                            <i class="fi fi-rr-plus" style="font-size: 18px; padding-right: 10px;"></i>
                            Nova conta
                        </a>
                    </li>
                    <li>
                        <a href="consultar_conta.php">
                            <i class="fi fi-rr-search" style="font-size: 18px; padding-right: 10px;"></i>
                            Consultar conta
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="fi fi-rr-exchange" style="font-size: 20px; padding-right: 10px;"></i>
                    Movimento
                    <i class="fi fi-rr-angle-small-right dropdown-arrow" style="font-size: 16px;"></i>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="realizar_movimento.php">
                            <i class="fi fi-rr-arrow-up" style="font-size: 18px; padding-right: 10px;"></i>
                            Realizar movimento
                        </a>
                    </li>
                    <li>
                        <a href="consultar_movimento.php">
                            <i class="fi fi-rr-search" style="font-size: 18px; padding-right: 10px;"></i>
                            Consultar movimento
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="_menu.php?close=1">
                    <i class="fi fi-rr-sign-out-alt" style="font-size: 20px; padding-right: 10px;"></i>
                    Sair
                </a>
            </li>
        </ul>
    </div>
</nav>