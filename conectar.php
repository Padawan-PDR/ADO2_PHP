<?php 
 
	function conectar()
	{
		try 
		{
			$db_file = "C:/xampp/htdocs/ADO2_PHP/storage/ADO2PHP.db"; // nome do banco de dados
			
			$pdo = new PDO("sqlite:$db_file"); // criar um objeto PDO
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // definir o atributo de tratamento de erros
			return $pdo; // retornar o objeto PDO
		} 
		catch (PDOException $e) 
		{
			echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
			throw $e;
		}
	}
 
?>
		