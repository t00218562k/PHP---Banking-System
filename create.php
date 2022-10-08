<?php
	$fname_valid = false; 
	$lname_valid = false;
	$dob_valid = false;
	$address_valid = false;
	$area_valid = false;
	$county_valid = false;
	$email_valid = false;
	$phone_valid = false;
	$Lodgment_valid = false;
	$type_valid = false;
	
	$invalid_dob = "";
	$invalid_fname = "";
	$invalid_lname = "";
	$invalid_address = "";
	$invalid_area = "";
	$invalid_county = "";
	$invalid_email = "";
	$invalid_phone = "";
	$invalid_lodgment = "";
	$invalid_type = "";
	
			
	if(strlen($_POST['fName'])>0 && strlen($_POST['fName'])<26 && ctype_alpha($_POST['fName']))
	//https://www.php.net/manual/en/function.strlen.php  ||https://www.geeksforgeeks.org/php-ctype_alpha-checks-for-alphabetic-value/
		$fname_valid = true;
	else
		$invalid_fname = "name too big or none alphabetic";
	//if to validate first name
	
	
	if(strlen($_POST['lName'])>0 && strlen($_POST['lName'])<26 && ctype_alpha($_POST['lName']))
		$lname_valid = true;
	else
		$invalid_lname = "name too big or none alphabetic";
	//if to validate last name
	
	
	if(strlen($_POST['dob'])==10)
	{
		$month = (int)substr($_POST['dob'], 5, -3);
		$day = (int)substr($_POST['dob'], 8);
		$valid_day = false;
		
		if(($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || $month==12)&& $day<=31)
			$valid_day = true;
		else if($month==2 && $day<=29)
			$valid_day = true;
		else if(($month==4 || $month==6 || $month==9 || $month==11) && $day<=30)
			$valid_day = true;
		
		if((is_numeric(substr($_POST['dob'], 0, 4)) && (int)substr($_POST['dob'], 0, 4)>1900)
			&& $_POST['dob'][4]=='-' && $_POST['dob'][7]=='-' && $valid_day)
		//https://www.php.net/manual/en/function.substr.php || https://www.geeksforgeeks.org/php-is_numeric-function/
			$dob_valid = true;
		else
			$invalid_dob = "DOB should be YYYY-MM-DD  e.g 1997-01-29";
	}
	else
		$invalid_dob = "DOB should be YYYY-MM-DD  e.g 1997-01-29";
	//if to validate date
	
	
	if(strlen($_POST['address'])<=50 && ctype_alnum(str_replace(' ', '', $_POST['address'])))
	//https://www.geeksforgeeks.org/php-ctype_alnum-check-for-alphanumeric/ || https://www.geeksforgeeks.org/php-str_replace-function/?ref=gcse
		$address_valid = true;
	else
		$invalid_address = "please enter address, no more then 50 characters";
	//if to validate  address
	
	
	if(strlen($_POST['area'])<=22 && ctype_alpha(str_replace(' ', '',$_POST['area'])))
		$area_valid = true;
	else
		$invalid_area = "please enter area, no more then 23 characters";
	//if to validate area
	
	
	if(strlen($_POST['county'])<=23 && ctype_alpha($_POST['county']))
		$county_valid = true;
	else
		$invalid_county = "please enter county, no more then 23 characters";
	//if to validate county
	
	
	if(strlen($_POST['email'])<=50 && strpos($_POST['email'], '@'))
	//https://www.php.net/manual/en/function.strpos.php
		$email_valid = true;
	else
		$invalid_email = "please enter email, no more then 50 characters and inlcude '@'";
	//if to validate email
	
	
	if(strlen($_POST['phone'])<=15 && strlen($_POST['phone'])>9 && (is_numeric($_POST['phone']) || (strpos($_POST['phone'], '+') 
		&& is_numeric(substr($_POST['phone'], 1)))))
		$phone_valid = true;
	else
		$invalid_phone = "invalid phone number e.g 0872231234 or +353 872326789";
	//if to validate phone
	
	
	if(is_numeric($_POST['lodgment']) && ((int)$_POST['lodgment']<=999999999999 && (int)$_POST['lodgment']>10))
		$Lodgment_valid = true;
	else
		$invalid_lodgment = "Sorry we cannot lodge that amount";
	//if to validate lodgment
	
	
	if($_POST['type']=='CA' || $_POST['type']=='SA' || $_POST['type']=='MA' || $_POST['type']=='CD')
		$type_valid = true;
	else
		$invalid_type = "Account must be either CA , SA , MA , CD";
	//if to validate account type
	
	
	if($fname_valid && $lname_valid && $dob_valid && $address_valid && $area_valid && $county_valid &&
	   $email_valid && $phone_valid && $Lodgment_valid && $type_valid)
	{
		try 
		{ 
			$pdo = new PDO('mysql:host=localhost;dbname=Banking; charset=utf8', 'root', ''); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'INSERT INTO guest_information(first_name,last_name,dob,address,area,county,email,phone)
			VALUES(:fName, :lName, :dob, :address, :area, :county, :email, :phone)';
			$result = $pdo->prepare($sql);
			$result->bindValue(':fName', $_POST['fName']); 
			$result->bindValue(':lName', $_POST['lName']); 
			$result->bindValue(':dob', $_POST['dob']); 
			$result->bindValue(':address', $_POST['address']); 
			$result->bindValue(':area', $_POST['area']); 
			$result->bindValue(':county', $_POST['county']); 
			$result->bindValue(':email', $_POST['email']); 
			$result->bindValue(':phone', $_POST['phone']); 
			$result->execute();

			include "createAccount.php";
			
		}
		catch (PDOException $e) 
		{ 
			$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
		}
	}
	else
		include "create.html";
?>