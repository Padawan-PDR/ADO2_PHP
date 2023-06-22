<?php
    include_once('conectar.php');
    include_once('operacoes.php');
?>

<!doctype HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Operações</title>
        <link rel="stylesheet" href="styleSheet.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>ISBN</th>
                <th>Ano de Publicação</th>
                <th>Editora</th>
                <th>Autoria</th>
                <th>Edição</th>
                <th>Páginas</th>
                <th>Largura mm</th>
                <th>Altura mm</th>
                <th>botao</th>
            </tr>
            <?php
                
                // Consulta de Produtos
                $dados = listarDados();
            ?>
        </table>
        <form>
            
        </form>
        <a href="cadastrar.php"> Inserir </a>

    </body>
</html>