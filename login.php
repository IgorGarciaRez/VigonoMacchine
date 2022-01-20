<?php
$cpf = $_POST['Cpf'];
$logar = $_POST['logar'];
$senha = $_POST['Senha'];
$connect = mysqli_connect('localhost','root','', 'vigono');
  if (isset($logar)) {

    $verifica = mysqli_query($connect, "SELECT * FROM cliente WHERE Cpf =
    '$cpf' AND Senha = '$senha'") or die("erro ao selecionar");
      if (mysqli_num_rows($verifica)<=0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='index.php';</script>";
        die();
      }else{
        setcookie("Cpf",$cpf);
        header("Location:index.php");
      }
  }else{
    echo "<script language='javascript' type='text/javascript'>
    window.location.href='index.php';</script>";
  }
?>