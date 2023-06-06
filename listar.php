<!doctype  HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Operações</title>
        <link rel="stylesheet" href="styleSheet.css">

        <?php
            include('conectar.php');
            include('operacoes.php');

            
        ?>
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
                $pdo = conectar();
                
                // Consulta de Produtos
                $dados = listar();
                tabela($dados);

                // Preparar e executar a consulta SQL
                $consulta = $pdo->prepare('SELECT COUNT(*) FROM Livro WHERE isbn = ?');
                $count = $consulta->fetchColumn();
            ?>
           
        </table>
    </body>
</html>