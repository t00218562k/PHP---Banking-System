<?php
	session_start();
	$userid = $_SESSION['UserID'];
	
	$transfer_valid = false;
	$account_valid = false;
	
	$invalid_transfer = "";
	$invalid_account = "";
	$valid_transfer = "";
	
	if(is_numeric($_POST['lAmount']) && (int)$_POST['lAmount']<=10000000)
		$transfer_valid = true;
	else
		$invalid_transfer = "please eneter amount within €100,00000";
	
	if(is_numeric($_POST['input_id']) && $_POST['input_id']!=$userid)
	{
		$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * FROM account WHERE accountid = :uid';
		$result = $pdo->prepare($sql);
		$result->bindValue(':uid', $_POST['input_id']); 
		$result->execute();

		$count = $result->rowCount();
		if ($count > 0)
			$account_valid = true;
		else
			$invalid_account = "Could not find account";
	}
	else
		$invalid_account = "Please enter a valid account number";
	
	
	if($transfer_valid && $account_valid)
	{
		try 
		{ 
			$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = 'SELECT * FROM account WHERE accountid = :uId';
			$result = $pdo->prepare($sql);
			$result->bindValue(':uId', $userid);
			$result->execute();

			$row = $result->fetch();
			
			if($row['balance']>$_POST['lAmount'])
			{
				$userBalance = $row['balance']-$_POST['lAmount'];
				
				
				$sql1 = 'UPDATE account SET balance=:cid WHERE accountid = :uId';
					$result1 = $pdo->prepare($sql1);
					$result1->bindValue(':cid', $userBalance); 
					$result1->bindValue(':uId', $userid);
					$result1->execute();
				
				
				$sq2 = 'SELECT * FROM account WHERE accountid = :cid';
				$result2 = $pdo->prepare($sq2);
				$result2->bindValue(':cid',  $_POST['input_id']); 
				$result2->execute();

				$row2 = $result2->fetch();
				$sentBalance = $row2['balance']+$_POST['lAmount'];
				
				
				$sql1 = 'UPDATE account SET balance=:balance WHERE accountid = :cid';
					$result1 = $pdo->prepare($sql1);
					$result1->bindValue(':balance', $sentBalance); 
					$result1->bindValue(':cid', $_POST['input_id']); 
					$result1->execute();
				
						
				$sql = 'INSERT INTO transaction_history(account_id,ammount,transaction) VALUES(:uId,:cid,"O")';
					$result1 = $pdo->prepare($sql);
					$result1->bindValue(':cid', $_POST['lAmount']); 
					$result1->bindValue(':uId', $userid);
					$result1->execute();
					
				$sql = 'INSERT INTO transaction_history(account_id,ammount,transaction) VALUES(:id,:amount,"I")';
					$result1 = $pdo->prepare($sql);
					$result1->bindValue(':id',  $_POST['input_id']); 
					$result1->bindValue(':amount', $_POST['lAmount']); 
					$result1->execute();
				
				$valid_transfer = "transfer was a success";
				include "transfer.html";
			}
			else
			{
				$invalid_transfer = "You do not have enough for this transaction";
				include "transfer.html";
			}
		} 
		catch (PDOException $e) 
		{ 

			$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

		}
	}
	else
		include "transfer.html";
	
?>