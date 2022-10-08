<?php
	session_start();
	$userid = $_SESSION['UserID'];
		try 
		{ 
			$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = 'SELECT balance FROM account WHERE accountid = :uId';
			$result = $pdo->prepare($sql);
			$result->bindValue(':uId', $userid);
			$result->execute();

			$row = $result->fetch() ;
			$balance = $row['balance'];
			
			echo "Balance ".$balance;

		}
	 
	catch (PDOException $e) 
	{ 

		$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

	}
?>			
<html>
	<form action="index.html" >	
		<input type="Submit" value="Go Back">
	</form>
</html>