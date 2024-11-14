function ValidarMeusDados() {
    var nome = document.getElementById("nome").value;
    var email = document.getElementById("email").value;
    var emailvalido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (nome.trim() == "") {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "warning",
            title: "Preencha o campo obrigatório ! "
            });
        $("#nome").focus();
        return false;
    }
    if (email.trim() == "") {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "warning",
            title: "Preencha o campo obrigatório ! "
            });
        $("#email").focus();
        return false;
    }
    if (!emailvalido.test(email)) {
        Swal.fire({
            title: "E-mail inválido",
            text: "Por favor, insira um e-mail válido.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
}

function ValidarCategoria() {
    if ($("#nome").val().trim() == "") {
        Swal.fire({
            title: "Nome da categoria",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#nome").focus();
        return false;
    }
}

function CadastrarEmpresa() {
    if ($("#nome").val().trim() == "") {
        Swal.fire({
            title: "Nome da empresa",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#nome").focus();
        return false;
    }
}

function CriarConta() {
    var banco = document.getElementById("banco").value;
    var agencia = document.getElementById("agencia").value;
    var conta = document.getElementById("conta").value;
    var saldo = document.getElementById("saldo").value;

    if (banco.trim() == "") {
        Swal.fire({
            title: "Nome do banco",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#banco").focus();
        return false;
    }
    if (agencia.trim() == "") {
        Swal.fire({
            title: "Agência",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#agencia").focus();
        return false;
    }
    if (conta.trim() == "") {
        Swal.fire({
            title: "Número da conta",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#conta").focus();
        return false;
    }
    if (saldo.trim() == "") {
        Swal.fire({
            title: "Saldo da conta",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#saldo").focus();
        return false;
    }
}

function ValidarLogin() {
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;
    var emailvalido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.trim() == "") {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "warning",
            title: "Preencha o campo obrigatório ! "
            });
        $("#email").focus();
        return false;
    }
    if (!emailvalido.test(email)) {
        Swal.fire({
            title: "E-mail inválido",
            text: "Por favor, insira um e-mail válido.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    if (senha.trim() == "") {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "warning",
            title: "Preencha o campo obrigatório ! "
            });
        $("#senha").focus();
        return false;
    }
}

function ValidarCadastro() {
    var nome = document.getElementById("nome").value;
    var email = document.getElementById("email").value;
    var senha1 = document.getElementById("senha1").value;
    var senha2 = document.getElementById("senha2").value;
    var emailvalido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (nome.trim() == "") {
        Swal.fire({
            title: "Seu nome",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#nome").focus();
        return false;
    }
    if (email.trim() == "") {
        Swal.fire({
            title: "Seu e-mail",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    if (!emailvalido.test(email)) {
        Swal.fire({
            title: "E-mail inválido",
            text: "Por favor, insira um e-mail válido.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    if (senha1.trim() == "") {
        Swal.fire({
            title: "Sua senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#senha1").focus();
        return false;
    }
    if (senha2.trim() == "") {
        Swal.fire({
            title: "Confirmação de senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#senha2").focus();
        return false;
    }
    if ($("#senha1").val().trim() != $("#senha2").val().trim()) {
        Swal.fire({
            title: "Senhas diferentes",
            text: "Por favor, certifique-se de que as senhas sejam iguais.",
            icon: "warning"
        });
        $("#senha2").focus();
        return false;
    }
    if (senha1.trim().length < 6) {
        Swal.fire({
            title: "Senha muito fraca",
            text: "A senha deve conter 6 ou mais caracteres.",
            icon: "warning"
        });
        $("#senha1").focus();
        return false;
    }
}

function ValidarMovimento() {
    var movimento = document.getElementById("movimento").value;
    var data = document.getElementById("data").value;
    var valor = document.getElementById("valor").value;
    var categoria = document.getElementById("categoria").value;
    var empresa = document.getElementById("empresa").value;
    var conta = document.getElementById("conta").value;

    if (movimento.trim() == "0") {
        Swal.fire({
            title: "Tipo de movimento",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#movimento").focus();
        return false;
    }
    if (data.trim() == "") {
        Swal.fire({
            title: "Data da movimentação",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#data").focus();
        return false;
    }
    if (valor.trim() == "") {
        Swal.fire({
            title: "Valor da movimentação",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#valor").focus();
        return false;
    }
    if (categoria.trim() == "") {
        Swal.fire({
            title: "Categoria",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#categoria").focus();
        return false;
    }
    if (empresa.trim() == "") {
        Swal.fire({
            title: "Empresa",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#empresa").focus();
        return false;
    }
    if (conta.trim() == "") {
        Swal.fire({
            title: "Conta",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#conta").focus();
        return false;
    }
}

function ValidarConsulta() {
    var datainicial = document.getElementById("datainicialconsulta").value;
    var datafinal = document.getElementById("datafinalconsulta").value;
    if (datainicial.trim() == "") {
        Swal.fire({
            title: "Data inicial",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#datainicialconsulta").focus();
        return false;
    }
    if (datafinal.trim() == "") {
        Swal.fire({
            title: "Data final",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#datafinalconsulta").focus();
        return false;
    }
}
function RedefinirSenha() {
    var email = document.getElementById("email").value;
    var senha_atual = document.getElementById("senha_atual").value;
    var rsenha1 = document.getElementById("rsenha1").value;
    var rsenha2 = document.getElementById("rsenha2").value;
    var emailvalido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.trim() == "") {
        Swal.fire({
            title: "Seu e-mail",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    if (senha_atual.trim() == "") {
        Swal.fire({
            title: "Sua senha atual",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#senha_atual").focus();
        return false;
    }
    if (rsenha1.trim() == "") {
        Swal.fire({
            title: "Sua nova senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#rsenha1").focus();
        return false;
    }
    if (rsenha2.trim() == "") {
        Swal.fire({
            title: "Repita sua nova senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#rsenha2").focus();
        return false;
    }
    if ($("#rsenha1").val().trim() != $("#rsenha2").val().trim()) {
        Swal.fire({
            title: "Senhas diferentes",
            text: "Por favor, certifique-se de que as novas senhas sejam iguais.",
            icon: "warning"
        });
        $("#rsenha2").focus();
        return false;
    }
    if (rsenha1.trim().length < 6) {
        Swal.fire({
            title: "Senha muito fraca",
            text: "A senha deve conter 6 ou mais caracteres.",
            icon: "warning"
        });
        $("#rsenha1").focus();
        return false;
    }
    if (!emailvalido.test(email)) {
        Swal.fire({
            title: "E-mail inválido",
            text: "Por favor, insira um e-mail válido.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    
    
}
function contarCaracteres() {
    const limiteCaracteres = 11;
    var maxnumber = document.getElementById("maxnumber");
    maxnumber.value = maxnumber.value.replace(/[^0-9]/g, '').slice(0, limiteCaracteres);
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresAgencia() {
    const limiteCaracteres = 4;
    var maxnumber = document.getElementById("agencia");
    maxnumber.value = maxnumber.value.replace(/[^0-9]/g, '').slice(0, limiteCaracteres);
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresNumeroConta() {
    const limiteCaracteres = 9;
    var maxnumber = document.getElementById("conta");
    maxnumber.value = maxnumber.value.replace(/[^0-9]/g, '').slice(0, limiteCaracteres);
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresSaldoConta() {
    const limiteCaracteres = 15;
    var maxnumber = document.getElementById("saldo");
    maxnumber.value = maxnumber.value.replace(/[^0-9]/g, '').slice(0, limiteCaracteres);
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresValorMov() {
    const limiteCaracteres = 15;
    var maxnumber = document.getElementById("valor");
    maxnumber.value = maxnumber.value.replace(/[^0-9]/g, '').slice(0, limiteCaracteres);
    document.getElementById("contador").textContent = maxnumber.value.length;
}
