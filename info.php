<?php
	session_start();
	$userid = $_SESSION['UserID'];
	try 
	{ 
		$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = 'SELECT account.date, account.balance, account.account, guest_information.first_name,
                 guest_information.last_name, guest_information.dob, guest_information.address,
				 guest_information.area, guest_information.county, guest_information.email, 
				 guest_information.phone 
				 FROM account
				 JOIN guest_information ON guest_information.guestid = account.guest_id
				 WHERE accountid = :gId';
		$result = $pdo->prepare($sql);
		$result ->bindValue(':gId', $userid);
		$result ->execute();
		
		$row = $result->fetch();
		
		echo "<style>
			table, th, td 
			{
			  border:1px solid black;
			  border-collapse: collapse;
			  padding: 10px;
			}
			td
			{
				color: #708090;
			}
			</style>";
			
		echo "<table>";
		echo "<tr><th>date account created</th><td>" .$row['date'] ."</td></tr>"  
			 ."<tr><th>Balance</th><td>€" .$row['balance'] ."</td></tr>" 
			 ."<tr><th>Account Type</th><td>" .$row['account'] ."</td></tr>" 
			 ."<tr><th>First Name</th><td>" .$row['first_name'] ."</td></tr>" 
			 ."<tr><th>Last Name</th><td>" .$row['last_name'] ."</td></tr>" 
			 ."<tr><th>DOB</th><td>" .$row['dob'] ."</td></tr>" 
			 ."<tr><th>Address</th><td>" .$row['address'] ."</td></tr>" 
			 ."<tr><th>Area</th><td>" .$row['area'] ."</td></tr>" 
			 ."<tr><th>County</th><td>" .$row['county'] ."</td></tr>" 
			 ."<tr><th>Email</th><td>" .$row['email'] ."</td></tr>" 
			 ."<tr><th>Phone</th><td>" .$row['phone'] ."</td></tr>" ;
		echo "</table>";
	}
	 
	catch (PDOException $e) 
	{ 

		$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

	}
?>
<html>
	<br><br>
	<form action="index.html" >	
		<input type="Submit" value="Go Back">
	</form>
<html>