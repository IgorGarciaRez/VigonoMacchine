<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $banco = "vigono";
    $conexao = mysql_connect($host, $user, $pass) or die (mysql_error());
    mysql_select_bd($banco) or die(mysql_error());


    $nome = $_POST['nomeC'];
    $Cpf = $_POST['cpf'];
    $Email = $_POST['email'];
    $Senha = $_POST['senhaC'];
    $sql = mysql_query("INSERT INTO cliente(nome, Cfp, Email, Senha)
                        VALUE ('$nome', '$Cpf', '$Email', '$Senha')");
?>