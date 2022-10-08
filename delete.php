<?php
	session_start();
	$userid = $_SESSION['UserID'];
		try 
		{ 
			$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = 'SELECT  guest_id FROM account WHERE accountid = :uId';
			$result = $pdo->prepare($sql);
			$result->bindValue(':uId', $userid);
			$result->execute();
			$row = $result->fetch();
			
			$gId = $row['guest_id'];
			
			$sql = 'DELETE FROM transaction_history WHERE account_id = :uId';
			$result = $pdo->prepare($sql);
			$result->bindValue(':uId', $userid);
			$result->execute();
			
			$sql = 'DELETE FROM account WHERE accountid = :uId';
			$result = $pdo->prepare($sql);
			$result->bindValue(':uId', $userid);
			$result->execute();

			$sql = 'DELETE FROM guest_information WHERE guestid = :gId';
			$result = $pdo->prepare($sql);
			$result->bindValue(':gId', $gId);
			$result->execute();
			
			include "login.html";
		}	 
	catch (PDOException $e) 
	{ 

		$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

	}
	
?>