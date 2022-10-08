<?php
	session_start();
	$userid = $_SESSION['UserID'];
	try 
	{ 
		$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = 'SELECT * FROM transaction_history WHERE account_id = :uId';
		$result = $pdo->prepare($sql);
		$result->bindValue(':uId', $userid);
		$result->execute();

		$count = $result->rowCount();
		
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
			
		if($count>0)
		{
			echo "<table>";
			echo "<tr>";
			echo "<th>Ammount</th>";
			echo "<th>Transaction Type</th>";
			echo "</tr>";
			while($row = $result->fetch())
			{
				echo "<tr>";
				echo "<td>".$row['ammount']."</td>";
				echo "<td>".$row['transaction']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else
			echo "You have no transactions yet";

		

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