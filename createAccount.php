<?php

	try
	{
		$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * FROM guest_information';
		$result = $pdo->prepare($sql);
		$result->execute();
	
		$count = $result->rowCount();

		while($row = $result->fetch())
		{
			$counter = 1;
			if($counter = $count)
				$newId = $row['guestid'];
			$counter++;
		}
			

		$date = date('Y-m-d');
		//https://stackoverflow.com/questions/470617/how-do-i-get-the-current-date-and-time-in-php
		
		$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'INSERT INTO account(guest_id, date, balance, Account)
		VALUES(:id, :date, :balance, :type)';
		$result = $pdo->prepare($sql);
		$result->bindValue(':id', $newId); 
		$result->bindValue(':date', $date); 
		$result->bindValue(':balance', $_POST['lodgment']); 
		$result->bindValue(':type', $_POST['type']); 
		$result->execute();
		
		$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT * FROM account';
		$result = $pdo->prepare($sql);
		$result->execute();
	
		$count = $result->rowCount();
		
		while($row = $result->fetch())
		{
			$counter = 1;
			if($counter = $count)
				$newUserId = $row['accountid'];
			$counter++;
		}
		
		$yourID =  "your new id is: ".$newUserId;
		include "createAccount.html";
	}
	catch (PDOException $e) 
	{
		$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
	}
?>