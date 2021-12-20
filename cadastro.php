<?php

    include "conexao.php";

    $nome = $_GET['nome'];
    $email = $_GET['email'];
    $login = $_GET['login'];
    $senha = $_GET['senha'];

    mysqli_select_db($connect, $banco) or die("erro na seleção do banco");

    if (isset($_GET['botao-enviar-cadastro'])){
        $sql = "INSERT INTO pessoa values(null, '".$nome."', '".$email."', '".$login."', '".$senha."')";
        if(mysqli_query($connect, $sql)){
            $msg = "Gravado com sucesso";
            echo "<script type='text/javascript'> 
            alert('$msg');
            window.location.href='formulario.html';</script>";
        }else{
            $msg = "Erro ao gravar";
            echo "<script type='text/javascript'> 
            alert('$msg');
            window.location.href='formulario.html';</script>";

        }

    }

    mysqli_close($connect);

?>