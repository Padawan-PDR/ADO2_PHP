<?php
   require_once('conectar.php');
   if ($transacaoOk) {
    $pdo->commit();
   } else {
    $pdo->rollback();
   }
?>