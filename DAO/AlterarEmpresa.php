<?php

require_once "../financeiro/_constante.php";

class AlterarEmpresa{
    public function Alterar($altempresa, $alttelefone, $altedereco){
            if (trim($altempresa)==''|| trim($alttelefone)==''|| trim($altedereco)==''){
                return FLAG_VAZIO;
            }
    }
}
?>