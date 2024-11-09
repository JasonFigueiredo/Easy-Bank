function ValidarMeusDados() {
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if (nome.trim() == "") {
        Swal.fire({
            title: "Nome de Usuário",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#nome").focus();
        return false;
    }
    if (email.trim() == "") {
        Swal.fire({
            title: "E-mail",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
}

function ValidarCategoria() {
    if ($("#nome").val().trim() == "") {
        Swal.fire({
            title: "Nome da Categoria",
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
            title: "Nome da Empresa",
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
            title: "Nome do Banco",
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
            title: "Número da Conta",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#conta").focus();
        return false;
    }
    if (saldo.trim() == "") {
        Swal.fire({
            title: "Saldo da Conta",
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

    if (email.trim() == "") {
        Swal.fire({
            title: "E-mail",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    if (senha.trim() == "") {
        Swal.fire({
            title: "Senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
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

    if (nome.trim() == "") {
        Swal.fire({
            title: "Seu Nome",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#nome").focus();
        return false;
    }
    if (email.trim() == "") {
        Swal.fire({
            title: "Seu E-mail",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#email").focus();
        return false;
    }
    if (senha1.trim() == "") {
        Swal.fire({
            title: "Sua Senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#senha1").focus();
        return false;
    }
    if (senha2.trim() == "") {
        Swal.fire({
            title: "Confirmação de Senha",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#senha2").focus();
        return false;
    }
    if ($("#senha1").val().trim() != $("#senha2").val().trim()) {
        Swal.fire({
            title: "Senhas Diferentes",
            text: "Por favor, certifique-se de que as senhas sejam iguais.",
            icon: "warning"
        });
        $("#senha2").focus();
        return false;
    }
    if (senha1.trim().length < 6) {
        Swal.fire({
            title: "Senha Muito Fraca",
            text: "A senha deve conter ao menos 6 caracteres.",
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
            title: "Tipo de Movimento",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#movimento").focus();
        return false;
    }
    if (data.trim() == "") {
        Swal.fire({
            title: "Data da Movimentação",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#data").focus();
        return false;
    }
    if (valor.trim() == "") {
        Swal.fire({
            title: "Valor da Movimentação",
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
            title: "Data Inicial",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#datainicialconsulta").focus();
        return false;
    }
    if (datafinal.trim() == "") {
        Swal.fire({
            title: "Data Final",
            text: "Por favor, preencha o campo obrigatório.",
            icon: "warning"
        });
        $("#datafinalconsulta").focus();
        return false;
    }
}
function contarCaracteres() {
    // Limite de caracteres permitido no imput
    const limiteCaracteres = 11;
    // puxa informaçõa do imput id "maxnumber"
    var maxnumber = document.getElementById("maxnumber");
    // value - puxa o que foi inserido no imput
    var maxnumberConteudo = maxnumber.value;
    // length - quantidade de caracteres
    if (maxnumberConteudo.length > limiteCaracteres) {
        // Enviar para o campo maxnumber somente os primeiros 15 caracteres
        // maxnumberConteudo - POssui o valor atual do imput
        // A função slice() permite extrair uma parte da string com base nos índices especificados. é utilizado o intervalo de 0 a 15. 
        maxnumber.value = maxnumberConteudo.slice(0, limiteCaracteres);
    }
    // Contar a quantidade de caracteres e enviar para o SELETOR "contador" no HTML
    // maxnumber.value.length - Contar a quantidade de caracteres
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresAgencia() {
    const limiteCaracteres = 4;
    var maxnumber = document.getElementById("agencia");
    var maxnumberConteudo = maxnumber.value;
    if (maxnumberConteudo.length > limiteCaracteres) {
        maxnumber.value = maxnumberConteudo.slice(0, limiteCaracteres);
    }
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresNumeroConta() {
    const limiteCaracteres = 9;
    var maxnumber = document.getElementById("conta");
    var maxnumberConteudo = maxnumber.value;
    if (maxnumberConteudo.length > limiteCaracteres) {
        maxnumber.value = maxnumberConteudo.slice(0, limiteCaracteres);
    }
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresSaldoConta() {
    const limiteCaracteres = 15;
    var maxnumber = document.getElementById("saldo");
    var maxnumberConteudo = maxnumber.value;
    if (maxnumberConteudo.length > limiteCaracteres) {
        maxnumber.value = maxnumberConteudo.slice(0, limiteCaracteres);
    }
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresValorMov() {
    const limiteCaracteres = 15;
    var maxnumber = document.getElementById("valor");
    var maxnumberConteudo = maxnumber.value;
    if (maxnumberConteudo.length > limiteCaracteres) {
        maxnumber.value = maxnumberConteudo.slice(0, limiteCaracteres);
    }
    document.getElementById("contador").textContent = maxnumber.value.length;
}