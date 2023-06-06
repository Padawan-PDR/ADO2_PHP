<?php 
 
  //Coloca os dados na tabela 
  function tabela($dados)
  {
    $count = 1;
    foreach ($dados as $linha) 
    {
        echo "<tr>";
        foreach ($linha as $valor) 
        {
            echo "<td>$valor</td>";
        }
        echo "<td><button name=\"deletar$count\">Deletar</button></td></tr>";
        
        $count++;
    }
  }

  //Lista os dados do Banco naa tabela
  function listar()
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

    // Preparar e executar a consulta SQL
    try 
    {
      $consulta = $pdo->prepare('SELECT * FROM Livro');
      $consulta->execute();
      $dados = $consulta->fetchAll(PDO::FETCH_NUM);
      return $dados;
    } 
    catch (PDOException $e) 
    {
      // Tratar erro de consulta
      echo 'Erro na consulta: ' . $e->getMessage();
      exit();
    }
  }


  function inserir($titulo, $isbn, $ano_publicacao, $editora, $autoria, 
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
      $cadastro->execute([$titulo, $isbn, $ano_publicacao, $editora, 
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

  function deletar()
  {

  }

?>