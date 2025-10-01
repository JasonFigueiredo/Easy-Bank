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
            title: "Campo obrigatório! "
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
            title: "Campo obrigatório!"
            });
        $("#email").focus();
        return false;
    }
    if (!emailvalido.test(email)) {
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
            title: "Preencha com um e-mail válido ! "
            });
        $("#email").focus();
        return false;
    }
}

function ValidarCategoria() {
    if ($("#nome").val().trim() == "") {
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
            title: "Campo obrigatório!"
            });
        $("#nome").focus();
        return false;
    }
}

function CadastrarEmpresa() {
    if ($("#nome").val().trim() == "") {
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
            title: "Campo obrigatório! "
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
            title: "Campo obrigatório! "
            });
        $("#banco").focus();
        return false;
    }
    if (agencia.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#agencia").focus();
        return false;
    }
    // verificar se o campo agencia tem 4 digitos
    if (agencia.trim().length <= 3){
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
            title: "O campo deve conter 4 dígitos! "
            });
        $("#agencia").focus();
        return false;
    }
    if (conta.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#conta").focus();
        return false;
    }
    // verificar se o campo conta tem 9 digitos
    if (conta.trim().length <= 8) {
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
            title: "O campo deve conter 9 dígitos! "
        });
        $("#conta").focus();
        return false;
    }

    if (saldo.trim() == "") {
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
            title: "Campo obrigatório! "
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
            title: "Campo obrigatório ! "
            });
        $("#email").focus();
        return false;
    }
    if (!emailvalido.test(email)) {
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
            title: "Preencha com um e-mail válido ! "
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
            title: "Campo obrigatório ! "
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
    // expressão regular para verificar se o email é válido
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
            title: "Campo obrigatório! "
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
            title: "Campo obrigatório! "
            });
        $("#email").focus();
        return false;
    }
    // verificar se o email é válido
    if (!emailvalido.test(email)) {
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
            title: "Preencha com um e-mail válido ! "
            });
        $("#email").focus();
        return false;
    }
    if (senha1.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#senha1").focus();
        return false;
    }
    if (senha2.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#senha2").focus();
        return false;
    }
    // verificar se as senhas são iguais
    if ($("#senha1").val().trim() != $("#senha2").val().trim()) {
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
            title: "Senhas diferentes! Digite senhas iguais. "
            });
        $("#senha1").focus();
        return false;
    }
    // verificar se a senha tem 6 digitos
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
            title: "Selecione o tipo de movimentação! "
            });
        $("#movimento").focus();
        return false;
    }
    if (data.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#data").focus();
        return false;
    }
    if (valor.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#valor").focus();
        return false;
    }
    if (categoria.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#categoria").focus();
        return false;
    }
    if (empresa.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#empresa").focus();
        return false;
    }
    if (conta.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#conta").focus();
        return false;
    }
}

function ValidarConsulta() {
    var datainicial = document.getElementById("datainicialconsulta").value;
    var datafinal = document.getElementById("datafinalconsulta").value;
    if (datainicial.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#datainicialconsulta").focus();
        return false;
    }
    if (datafinal.trim() == "") {
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
            title: "Campo obrigatório! "
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
            title: "Campo obrigatório! "
            });
        $("#email").focus();
        return false;
    }
    if (senha_atual.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#senha_atual").focus();
        return false;
    }
    if (rsenha1.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#rsenha1").focus();
        return false;
    }
    if (rsenha2.trim() == "") {
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
            title: "Campo obrigatório! "
            });
        $("#rsenha2").focus();
        return false;
    }
    // verificar se as senhas são iguais
    if ($("#rsenha1").val().trim() != $("#rsenha2").val().trim()) {
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
            title: "Senhas diferentes! Digite senhas iguais. "
            });
        $("#rsenha1").focus();
        $("#rsenha2").focus();
        return false;
    }
    // verificar se a senha tem 6 digitos
    if (rsenha1.trim().length < 6) {
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
            title: "Senha muito fraca! No mínimo 6 caracteres. "
            });
        $("#rsenha1").focus();
        return false;
    }
    // verificar se o email é válido
    if (!emailvalido.test(email)) {
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
            title: "Preencha com um e-mail válido ! "
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
    if (maxnumber.value.length === limiteCaracteres) {
        maxnumber.value = maxnumber.value.slice(0, -1) + '-' + maxnumber.value.slice(-1);
    }
    document.getElementById("contador").textContent = maxnumber.value.length;
}
function contarCaracteresSaldoConta() {
    const limiteCaracteres = 15;
    var maxnumber = document.getElementById("saldo");
    maxnumber.value = maxnumber.value.replace(/[^0-9.,]/g, '').slice(0, limiteCaracteres);
    var visualValue = maxnumber.value.replace(',', '.');
    document.getElementById("contador").textContent = visualValue.length;
    maxnumber.value = new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(parseFloat(visualValue.replace(',', '.')));
}
function contarCaracteresValorMov() {
    const limiteCaracteres = 15;
    var maxnumber = document.getElementById("valor");
    maxnumber.value = maxnumber.value.replace(/[^0-9]/g, '').slice(0, limiteCaracteres);
    document.getElementById("contador").textContent = maxnumber.value.length;
}

 // Função para alternar tema
 function toggleTheme() {
    const body = document.body;
    const themeCheckbox = document.getElementById('theme-checkbox');
    const currentTheme = body.getAttribute('data-theme');
    
    if (currentTheme === 'dark') {
        body.removeAttribute('data-theme');
        if (themeCheckbox) {
            themeCheckbox.checked = false;
        }
        localStorage.setItem('theme', 'light');
    } else {
        body.setAttribute('data-theme', 'dark');
        if (themeCheckbox) {
            themeCheckbox.checked = true;
        }
        localStorage.setItem('theme', 'dark');
    }
}

// Carregar tema salvo ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme');
    const themeCheckbox = document.getElementById('theme-checkbox');
    
    if (savedTheme === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
        if (themeCheckbox) {
            themeCheckbox.checked = true;
        }
    } else {
        if (themeCheckbox) {
            themeCheckbox.checked = false;
        }
    }
    
    // Adicionar evento de clique no switch
    if (themeCheckbox) {
        themeCheckbox.addEventListener('change', function() {
            toggleTheme();
        });
    }
});
