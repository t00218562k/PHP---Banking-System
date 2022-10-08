<?php
	session_start();

	$valid = "";
	
	if(isset($_POST['input_id']))
	{	
		$_SESSION['UserID'] = $_POST['input_id'];
		
		try 
		{ 
			$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'SELECT * FROM account WHERE accountid = :uid';
			$result = $pdo->prepare($sql);
			$result->bindValue(':uid', $_POST['input_id']); 
			$result->execute();

			$count = $result->rowCount();
			if ($count > 0)
			{
				include "index.html";
			}
			else
			{
				$valid = "Incorrect login ID";
				include "Login.html";
			}
		}
		 
		catch (PDOException $e) { 

			$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

		}
	}
?>
