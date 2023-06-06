<?php
   if ($transacaoOk) {
    $pdo->commit();
   } else {
    $pdo->rollback();
   }
?>