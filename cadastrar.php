<?php
try {
    include_once('abrir_transacao.php');
    include ('operacoes.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $titulo = $_POST['titulo'];
        $isbn = $_POST['isbn'];
        $ano_publicacao = $_POST['ano_Publicacao'];
        $editora = $_POST['editora'];
        $autoria = $_POST['autoria'];
        $edicao = $_POST['edicao'];
        $paginas = $_POST['paginas'];
        $largura_mm = $_POST['largura_mm'];
        $altura_mm = $_POST['altura_mm'];
    
        inserir($titulo, $isbn, $ano_publicacao, $editora, $autoria, $edicao, $paginas, $largura_mm, $altura_mm);            
        header("Location: listar.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"  crossorigin="anonymous">
        <title>Cadastrar</title>

    </head>
    <body class="bg-primary text-white">

                    <h1>Inserir um produto</h1>
                </div>
            </div><table class="table table-dark container"> 
                        <thead class="thead-dark table-bordered">
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
                        </tr>
                        </thead>
                        <form name="fom" action="cadastrar.php" method="POST">
                            
                        
                        <tr  class="">
                            <td>?</td>
                            <td><input type="text" name="titulo"></td>
                            <td><input type="text" name="isbn"></td>
                            <td><input type="date" name="ano_Publicacao"></td>
                            <td><input type="text" name="editora"></td>
                            <td><input type="text" name="autoria"></td>
                            <td><input type="num" name="edicao"></td>
                            <td><input type="num" name="paginas"></td>
                            <td><input type="num" name="largura_mm"></td>
                            <td><input type="num" name="altura_mm"></td>                

                        </tr>
                            <h1>Mudar os dados de um produto</h1>
                            <input type="submit" value="Inserir" class="btn row">
                        
                        
                        </form>
                </table>
            </div>
        </div>
        </div>   
    </body>
</html>
<?php
    $transacaoOk = true;
} finally {
    include_once('fechar_transacao.php');
}
?>