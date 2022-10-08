<?php
	session_start();
	$userid = $_SESSION['UserID'];
	$transaction = "";
	
	if($_POST['lAmount']>0 && is_numeric($_POST['lAmount']))
	{
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
			$lAmount = $_POST['lAmount'];
			
			if(($lAmount+$balance)<999999999999)
			{
				$balance = $balance-$lAmount;		
				$sql1 = 'UPDATE account SET balance=:uBalance WHERE accountid = :uId';
				$result1 = $pdo->prepare($sql1);
				$result1->bindValue(':uBalance', $balance); 
				$result1->bindValue(':uId', $userid);
				$result1->execute();

				
				$sql = 'SELECT balance FROM account WHERE accountid = :uId';
				$result = $pdo->prepare($sql);
				$result->bindValue(':uId', $userid);
				$result->execute();

				$row = $result->fetch() ;
				$balance1 = $row['balance'];
				
				$transaction = "Balance ".$balance1;
				
				$sql = 'INSERT INTO transaction_history(account_id,ammount,transaction) VALUES(:uId,:lAmmount,"L")';
				$result1 = $pdo->prepare($sql);
				$result1->bindValue(':lAmmount', $lAmount); 
				$result1->bindValue(':uId', $userid);
				$result1->execute();
				
				include "lodgment.html";
			}
				
			else
			{
				$transaction = "We cannot hold that ammount";
				include "lodgment.html";
			}
						
		}	
		catch (PDOException $e) 
		{ 
			$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
		}
	}
	else
	{
		$transaction = "Please enter a number value";
		include "lodgment.html";
	}
?>