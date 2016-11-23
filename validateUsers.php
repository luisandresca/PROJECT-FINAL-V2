<?php 
include 'Classes/ClassLanguage.cls.php';
include 'Classes/ClassCategory.cls.php';
include 'Classes/ClassSubCategory.cls.php';
include 'Classes/dbConnection.php';

$conn= new PDO("mysql:host=$host;dbname=$dbname",$user, $pass);

//Diferent names for load the pages
//$utype="Administrator";
//$utype="Customer";
//$utype="Employee";



if (isset($_POST['email'])&& isset($_POST['pass']))
{
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	$sqlCmd ="SELECT * FROM `members`
			  WHERE email=:emailp
			  AND password=:passp";
	
	
	$prepQuery = $conn ->prepare($sqlCmd);
	$prepQuery->bindParam(":emailp",$email, PDO::PARAM_STR);
	$prepQuery->bindParam(":passp",$pass, PDO::PARAM_STR);
	$prepQuery->execute();
	$resultSearch= $prepQuery->fetchAll();
	
	print_r($resultSearch);
	
	if ($resultSearch>0)
	{
		foreach ($resultSearch as $oneRec)
		{
			if ($resultSearch['mTypeID']='1')
			{
				header('Location:indexAdministrator.php');		
			}
			elseif ($resultSearch['mTypeID']='2')
			{
				header('Location:indexEmployee.php');
			}
			else
			{
				header('Location:indexCustomer.php');
			}
		}
		
	}
	else
	{
		header('Location:login.php');
		echo "This user does not exist";
	}
	
}






?>
