<?php
if (isset($_GET['ret'])) {
    $ret = $_GET["ret"];
}
if (isset($ret)) {

    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
            Preencha o(s) campo(s) obrigatório(s)!
            </div>';
            break;

        case 1:
            echo '<script> Swal.fire({
            title: "Sucesso",
            text: "Ação realizada com sucesso.",
            icon: "success"
            });</script>';
            break;

        case -1:
            echo '<script> Swal.fire({
            title: "Erro",
            text: "Ocorreu um erro na operação. Tente mais tarde!",
            icon: "error"
            });</script>';
            break;

        case -2:
            echo '<div class="alert alert-danger">
            Senhas diferentes. Por favor, digite senhas iguais!
            </div>';
            break;

        case -3:
            echo '<div class="alert alert-warning">
            A senha deve conter 6 ou mais caracteres!
            </div>';
            break;

        case -4:
            echo '<script> Swal.fire({
            title: "Erro",
            text: "O registro não pode ser excluído, pois está em uso!",
            icon: "error"
            });</script>';
            break;

        case -5:
            echo '<script> Swal.fire({
            title: "E-mail já cadastrado",
            text: "Por favor, escolha outro e-mail.",
            icon: "error"
            });</script>';
            break;

        case -6:
            echo '<script> Swal.fire({
            title: "Usuário não encontrado",
            text: "Por favor, verifique o e-mail informado.",
            icon: "error"
            });</script>';
            break;

        case -7:
            echo '<script> Swal.fire({
            title: "Sem Movimentação",
            text: "Nenhuma movimentação encontrada.",
            icon: "question"
            });</script>';
            break;
        case -8:
            echo '<script> Swal.fire({
            title: "Insira Senhas Diferentes",
            text: "A sua senha não pode ser igual a anterior.",
            icon: "warning"
            });</script>';
            break;
        case -10:
            echo '<script> Swal.fire({
            title: "Usuário não encontrado",
            text: "Por favor, digite o e-mail ou senha corretamente.",
            icon: "error"
            });</script>';
            break;
        case -11:
            echo '<script> Swal.fire({
            title: "E-mail Inválido",
            text: "Por favor, insira um e-mail válido.",
            icon: "warning"
            });</script>';
            break;
    }
}
