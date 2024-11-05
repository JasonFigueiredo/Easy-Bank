<?php
if (isset($_GET['ret'])) {
    $ret = $_GET["ret"];
}
if (isset($ret)) {

    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
            Preencher o(s) campo(s) obrigatorio(s)!
            </div>';
            break;
        case 1:
            echo '<div class="alert alert-success">
            Ação realizada com sucesso!
            </div>';
            // echo '<script> Swal.fire({
            // title: "Sucesso",
            // text: "Ação realizada com sucesso",
            // icon: "success"
            // });</script>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
            Ocorreu um erro na operação. Tente mais tarde!
            </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
            Senhas estão diferentes, Por favor, digite as senhas iguais!
            </div>';
            break;
        case -3:
            echo '<div class="alert alert-warning">
           A senha deve conter mais de 6 caracteres!
           </div>';
            break;
        case -4:
            echo '<div class="alert alert-warning">
           O registro não poderá ser excluido, pois está em uso !
           </div>';
            break;
        case -5:
            echo '<div class="alert alert-warning">
           O e-mail já está cadastrado, por favor, escolha outro e-mail.
           </div>';
            break;
        case -6:
            echo '<div class="alert alert-warning">
           Usuario não encontrado.
           </div>';
            break;
        case -7:
            echo '<div class="alert alert-warning">
           Nenhuma movimentação encontrada.
           </div>';
            break;
        case -8:
            echo '<script> Swal.fire({
                title: "<strong>Redefinir senha</strong>",
                icon: "info",
                html: `
                    Para alterar sua senha, por favor entre em contato com o nosso suporte técnico. Seguindo o link abaixo:
                    <a href="mailto:jasonlopes132@gmail.com?subject=Redefinição de senha. &body=Conteúdo do email que será preenchido automaticamente"" autofocus> -- Solicitar redefinição de senha - </a>
                `,
                focusConfirm: false,
                confirmButtonText: `
                    <i class="fa fa-thumbs-up"></i> OK!
                `,
                confirmButtonAriaLabel: "Thumbs up, great!"
                });</script>';
            break;
    }
}
