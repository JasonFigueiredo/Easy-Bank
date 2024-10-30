<?php
require_once "../financeiro/_constante.php";

 class AlterarContaDAO{
    public function AlterarConta($nome,$agencia,$conta,$saldo){
        if(trim($nome)==""|| trim($agencia)==""|| trim($conta)==""|| trim($saldo)==""){
            return FLAG_VAZIO;
        }
    }
}
