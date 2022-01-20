<?php

$nome = $_POST['nome'];
$senha = $_POST['Senha'];
$cpf = $_POST['Cpf'];
$email = $_POST['Email'];
$connect = mysqli_connect('localhost','root','', 'vigono');
//$db = mysqli_select_db($connect, 'vigono');
$query_select = "SELECT Cpf FROM cliente WHERE Cpf = '$cpf'";
$select = mysqli_query($connect, $query_select);
$array = mysqli_fetch_array($select);
$logarray = isset($array['Cpf']) ? count($array['Cpf']) : 0;

  if($cpf == "" || $cpf == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo cpf deve ser preenchido');window.location.href='
    cadastro.html';</script>";

  }else{
    if($logarray == $cpf){

      echo"<script language='javascript' type='text/javascript'>
      alert('Esse login já existe');window.location.href='
      cadastro.html';</script>";
      die();

    }else{
      $query = "INSERT INTO cliente (nome,Cpf,Email,Senha) VALUES ('$nome','$cpf','$email','$senha')";
      $insert = mysqli_query($connect,$query);
      if(!$insert)
      {
          echo mysqli_error($connect);
          die();
      }
      else
      {
          echo "Query succesfully executed!";
      }

      if($insert){
        echo"<script language='javascript' type='text/javascript'>
        alert('Usuário cadastrado com sucesso!');window.location.
        href='index.php'</script>";
      }else{
        echo"<script language='javascript' type='text/javascript'>
        alert('Não foi possível cadastrar esse usuário');window.location
        .href='index.php'</script>";
      }
    }
  }
?>