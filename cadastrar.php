<?php
    try
    {
        include_once('abrir_transacao.php');
        require_once("operacoes.php");
        

    if ($_SERVER["REQUEST_METHOD"] == "GET") 
        {
            if (!isset($_GET['id'])) 
            {
                // Inserção
                echo "<!DOCTYPE html>
                <html lang=\"pt-br\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM\" crossorigin=\"anonymous\">
                        <title>Cadastrar</title>
                
                    </head>";
                echo "<body class=\"bg-secondary text-white \">";
                echo "<h2>Inserir Livro</h2>";
                echo "<div class='form-container'>";
                    echo "<form class='form' method='post' action='cadastrar.php'>";
                        echo "<div class='form-group'>";
                        echo "<h2>ID ?</h2>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Título:</label>";
                        echo "<input type='text' name='titulo' required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>ISBN:</label>";
                        echo "<input type='text' name='isbn'  required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Ano de Publicação:</label>";
                        echo "<input type='date' name='ano_Publicacao' required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Editora:</label>";
                        echo "<input type='text' name='editora' required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Autoria:</label>";
                        echo "<input type='text' name='autoria'  required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Edição:</label>";
                        echo "<input type='text' name='edicao'  required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Número de Páginas:</label>";
                        echo "<input type='number' name='paginas'   required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Largura (mm):</label>";
                        echo "<input type='number' name='largura_mm'  required><br>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label>Altura (mm):</label>";
                        echo "<input type='number' name='altura_mm'  required><br>";
                        echo "</div>";
                        echo "<input type='submit' value='Inserir'>";
                    echo "</form>";
                echo "</div>";
            } 
            else 
            {
                // Alteração
                echo "<h2>Alterar Livro</h2>";
                $id = $_GET['id'];
                $stmt = $pdo->prepare("SELECT * FROM Livro WHERE id = ?");
                $stmt->execute([$id]);
                $livro = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($livro) 
                {
                    
                    echo "<h1>ID " . $livro['id'] . "</h1>";
                    echo "<form method='post' action='listar.php'>";
                    echo "<label>Título:</label>";
                    echo "<input type='text' name='titulo' value='" .  $livro['titulo'] . "' required><br>";
                    echo "<label>ISBN:</label>";
                    echo "<input type='text' name='isbn' value='" .  $livro['isbn'] . "' required><br>";
                    echo "<label>Ano de Publicação:</label>";
                    echo "<input type='date' name='ano_Publicacao' value='" .  $livro['ano_Publicacao'] . "' required><br>";
                    echo "<label>Editora:</label>";
                    echo "<input type='text' name='editora' value='" .  $livro['editora'] . "' required><br>";
                    echo "<label>Autoria:</label>";
                    echo "<input type='text' name='autoria' value='" .  $livro['autoria'] . "' required><br>";
                    echo "<label>Edição:</label>";
                    echo "<input type='number' name='edicao' value='" .  $livro['edicao'] . "' required><br>";
                    echo "<label>Número de Páginas:</label>";
                    echo "<input type='number' name='paginas' value='" .  $livro['paginas'] . "' required><br>";
                    echo "<label>Largura (mm):</label>";
                    echo "<input type='number' name='largura_mm' value='" .  $livro['largura_mm'] . "' required><br>";
                    echo "<label>Altura (mm):</label>";
                    echo "<input type='number' name='altura_mm' value='" .  $livro['altura_mm'] . "' required><br>";
                    echo "<input type='hidden' value=' " . $_GET('id') . " '>";
                    echo "<input type='submit' value='Alterar'>";
                    echo "</form>";
                }
                else 
                {
                    echo "Livro não encontrado.";
                }
            }
        } 
        elseif ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if (isset($_POST['id'])) 
            {
                // Alteração
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $isbn = $_POST['isbn'];
                $ano_publicacao = $_POST['ano_publicacao'];
                $editora = $_POST['editora'];
                $autoria = $_POST['autoria'];
                $edicao = $_POST['edicao'];
                $paginas = $_POST['paginas'];
                $largura_mm = $_POST['largura_mm'];
                $altura_mm = $_POST['altura_mm'];

                // Realizar a alteração no banco de dados
                $livroAlterado = alterar($id, $titulo, $isbn, $ano_publicacao, $editora, $autoria, $edicao, $paginas, $largura_mm, $altura_mm);
                if ($livroAlterado) {
                    echo "Livro alterado com sucesso. Redirecionando para a página de listagem...";
                    header("Location: listar.php");
                    exit();
                } else {    
                    echo "Falha ao alterar o livro.";
                }
            } 
            else 
            {
                // Inserção
                $titulo = $_POST['titulo'];
                $isbn = $_POST['isbn'];
                $ano_publicacao = $_POST['ano_Publicacao'];
                $editora = $_POST['editora'];
                $autoria = $_POST['autoria'];
                $edicao = $_POST['edicao'];
                $paginas = $_POST['paginas'];
                $largura_mm = $_POST['largura_mm'];
                $altura_mm = $_POST['altura_mm'];

                // Realizar a inserção no banco de dados
                $livroInserido = inserir($titulo, $isbn, $ano_publicacao, $editora, $autoria, $edicao, $paginas, $largura_mm, $altura_mm);
                if ($livroInserido) 
                {
                    echo "Livro inserido com sucesso. Redirecionando para a página de listagem...";
                    header("Location: listar.php");
                    exit();
                } 
                else 
                {
                    echo "Falha ao inserir o livro.";
                }
            }
        }
    
        ?>
        <div>
            <a href="listar.php">BD</a>
        </div>
    </body>
</html>
<?php
    $transacaoOk = true;
    } 
    finally 
    {
        include_once('fechar_transacao.php');
    }
?>