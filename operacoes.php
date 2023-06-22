<?php 
  require_once("conectar.php");

  function listarDados()
  {
      // Conectar ao banco de dados
      $pdo=conectar();
      $stmt = $pdo->query("SELECT id, titulo, isbn, ano_Publicacao, editora, 
      autoria, edicao, paginas, largura_mm, altura_mm FROM Livro");

      // Iterar sobre os resultados
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
          echo "<tr>";
          echo "<form method='GET' action='cadastrar.php/'" . $row['id'] . ">";

            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['titulo']."</td>";
            echo "<td>".$row['isbn']."</td>";
            echo "<td>".$row['ano_Publicacao']."</td>";
            echo "<td>".$row['editora']."</td>";
            echo "<td>".$row['autoria']."</td>";
            echo "<td>".$row['edicao']."</td>";
            echo "<td>".$row['paginas']."</td>";
            echo "<td>".$row['largura_mm']."</td>";
            echo "<td>".$row['altura_mm']."</td>";
            echo "<td>";
            

            echo "<input type='hidden' name='id' value='". $row['id'] . "'>";
            echo "<input type='hidden' name='livro_Titulo' value='" . $row['titulo'] . "'>";
            echo "<input type='hidden' name='livro_Isbn' value='" . $row['isbn'] . "'>";
            echo "<input type='hidden' name='livro_Ano_Publicacao' value='" . $row['ano_Publicacao'] . "'>";
            echo "<input type='hidden' name='livro_Editora' value='" . $row['editora'] . "'>";
            echo "<input type='hidden' name='livro_Autoria' value='" . $row['autoria'] . "'>";
            echo "<input type='hidden' name='livro_Edicao' value='" . $row['edicao'] . "'>";
            echo "<input type='hidden' name='livro_Paginas' value='" . $row['paginas'] . "'>";
            echo "<input type='hidden' name='livro_Largura_mm' value='" . $row['largura_mm'] . "'>";
            echo "<input type='hidden' name='livro_Altura_mm' value='" . $row['altura_mm'] . "'>";
            echo "<input type='hidden' name='modo_edicao' value='true'>"; // Campo oculto indicando o modo de edição
            echo "<input type='submit' value='Editar'>";
              
          echo "</form>";
          echo "</tr>"; 

          
      }
  }

  function inserir($titulo, $isbn, $ano_Publicacao, $editora, $autoria, 
  $edicao, $paginas, $largura_mm, $altura_mm)
  {
    // Conectar ao banco de dados
    try 
    {
      $pdo = conectar();
    } 
    catch (PDOException $e) 
    {
      // Tratar erro de conexão
      echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
      exit();
    }

    // Verificar se o valor de isbn já existe na tabela
    try 
    {
      $consulta = $pdo->prepare('SELECT COUNT(*) FROM Livro WHERE isbn = ?');
      $consulta->execute([$isbn]);
      $count = $consulta->fetchColumn();
      if ($count > 0) 
      {
        echo 'Erro: Já existe um livro com este ISBN na tabela.';
        exit();
      }
    } 
    catch (PDOException $e) 
    {
      // Tratar erro de consulta
      echo 'Erro na consulta: ' . $e->getMessage();
      exit();
    }

    // Preparar e executar a consulta SQL
    try 
    {
      $cadastro = $pdo->prepare
      ('INSERT INTO Livro(titulo, isbn, ano_Publicacao, editora, 
      autoria, edicao, paginas, largura_mm, altura_mm) 
      VALUES (?, ?, ?, ?, ?, ?, ? ,? ,?)');
      $cadastro->execute([$titulo, $isbn, $ano_Publicacao, $editora, 
      $autoria, $edicao, $paginas, $largura_mm, $altura_mm]);
      
      // Retornar o ID do último registro inserido
      return $pdo->lastInsertId();
    } 
    catch (PDOException $e) 
    {
      // Tratar erro de consulta
      echo 'Erro na consulta: ' . $e->getMessage();
      exit();
    
    }
  }

  function alterar()
{
    // Conectar ao banco de dados
    try 
    {
      $pdo = conectar();
    } 
    catch (PDOException $e) 
    {
        // Tratar erro de conexão
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit();
    }

    // Verificar se o valor de isbn já existe na tabela
    try 
    {
        $consulta = $pdo->prepare('SELECT COUNT(*) FROM Livro WHERE isbn = ?');
        $consulta->execute([$isbn]);
        $count = $consulta->fetchColumn();
        if ($count > 0) 
        {
            echo 'Erro: Já existe um livro com este ISBN na tabela.';
            exit();
        }
    } 
    catch (PDOException $e) 
    {
        // Tratar erro de consulta
        echo 'Erro na consulta: ' . $e->getMessage();
        exit();
    }

    // Preparar e executar a consulta SQL
    try 
    {
        $cadastro = $pdo->prepare('UPDATE Livro SET titulo = ?, isbn = ?, ano_publicacao = ?, 
        editora = ?, autoria = ?, edicao = ?, paginas = ?, largura_mm = ?, altura_mm = ?');
        $cadastro->execute([$titulo, $isbn, $ano_Publicacao, 
        $editora, $autoria, $edicao, $paginas, $largura_mm, $altura_mm]);

        // Retornar o ID do último registro inserido
        return $pdo->lastInsertId();
    } 
    catch (PDOException $e) 
    {
        // Tratar erro de consulta
        echo 'Erro na consulta: ' . $e->getMessage();
        exit();
    }
}

  // Função para deletar uma linha do banco de dados SQLite
function deletarLinha($id)
{
    // Conectar ao banco de dados
    $pdo = conectar();

    // Query para deletar a linha com base no ID
    $query = "DELETE FROM Livro WHERE id = :id";

    // Preparar a query
    $stmt = $pdo->prepare($query);

    // Vincular o parâmetro ID
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Executar a query
    $stmt->execute();

    // Verificar se a deleção foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        echo "Linha deletada com sucesso.";
    } else {
        echo "Falha ao deletar a linha.";
    }
}

  function verificarSenha($senhaDigitada) 
  {
    // Aqui você pode adicionar a lógica para verificar a senha digitada
    if ($senhaDigitada === 'CudeAlho') {
      echo "Senha correta! Voce tem certeza dessa ação.";
      
    } else {
      echo "Senha incorreta! Ação não permitida.";
      // Faça algo quando a senha estiver incorreta
    }
  }


  function listarId()
  {
      // Conectar ao banco de dados
      $pdo = conectar();
      $stmt = $pdo->query("SELECT id FROM Livro ORDER BY id");
  
      // Iterar sobre os resultados
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<option value=\"id" . $row['id'] . "\">" . $row['id'] . "</option>";
      }
  } 
  ?>  