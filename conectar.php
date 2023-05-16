<?php 
    $pdo = new PDO("sqlite:host=localhost; dbname=Livro; charset=utf-8","root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    print_r($pdo);
?>