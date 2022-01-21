<?php

session_start();
$token = session_id();
if(isset($_GET['token']) && $_GET['token'] === $token) {
   session_destroy();
   header("location: index.php");
   exit();
} else {
   echo '<a href="logout.php?token='.$token.'>Confirmar logout</a>';
}

?>