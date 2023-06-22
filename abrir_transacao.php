<?php 
   require_once('conectar.php');

   $pdo = conectar();
   $pdo->beginTransaction();
   $transacaoOk = false;

?>