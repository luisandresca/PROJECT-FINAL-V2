<?php
include 'ClassClient.cls.php';

class Employee extends Client {
	
	
	function deleteClient($conn, $clientEmail, $clientPass)
	{
		$sqlCmd= "Select mID FROM members WHERE email=:emailp AND password=:passp";
		
		$preQuery = $conn ->prepare($sqlCmd);
		$preQuery -> BindValue (":emailp",$clientEmail,PDO::PARAM_STR);
		$preQuery -> bindParam (":passp",$clientPass, PDO::PARAM_STR);
		$preQuery -> execute();
		$result = $preQuery->fetchAll();
		
		$counterAds=0;
		$counterClients=0;
		$counterMember=0;
		
		foreach ($result as $oneRec)
		{
			$sqlCmd ="DELETE FROM ads WHERE mID =".$oneRec["mID"].";";
			$result = $conn -> exec($sqlCmd);
			if (!empty($result)) { $counterAds++;} 
			
			
			$sqlCmd ="DELETE FROM clients WHERE mID = ".$oneRec["mID"].";";
			$result = $conn -> exec($sqlCmd);
			if (!empty($result)) { $counterClients++;} 
			
			
			$sqlCmd ="DELETE FROM members WHERE mID = ".$oneRec["mID"].";";
			$result = $conn -> exec($sqlCmd);
			if (!empty($result)) { $counterMember++;}//Number of times that the client is in the table member
			
			
		}
		
		echo "ad deleted =".$counterAds."</br>"; //number of ads associated to the client
		echo "client deleted =".$counterClients."</br>"; //number of times that the user is in table Client
		echo "Member deleted =".$counterMember."</br>"; //Number of times that the user is in the table member


		
		/*
	    
	    //Other way to delete
	    //Delete by one record: one ad, one client, one member
	    
		$sqlCmd= " START TRANSACTION;
		SET @email='".$clientEmail."';
		SET @pass='".$clientPass."';
	
	
		SELECT @A:=mID FROM members WHERE email=@email AND password=@pass;
		DELETE FROM ads WHERE mID = @A;
		DELETE FROM clients WHERE mID = @A;
		DELETE FROM members WHERE mID = @A;
	
		COMMIT;
		";
		*/
		
		
		return $result;

	
	}
	
	
	
	function findClientByID($conn, $cID)
	{
		$sqlCmd="SELECT mID FROM Clients WHERE cID=:clientID";
		
		$prepQuery= $conn->prepare($sqlCmd);
		$prepQuery->bindParam(":clientID",$cID, PDO::PARAM_INT);
		$prepQuery->execute();
		$result = $prepQuery->fetchAll();
		
		if (!empty ($result))
		{
			echo "Client Found </br>";
		}
		else
		{
			echo"Client Not Found </br>";
		}
		
		//print_r($result);
		
		foreach ($result as $oneRec)
		{
			$mID = $oneRec["mID"];
		}
		
		return $mID;
		
	}
	
	function findClientByName($conn, $cName)
	{
		$clientType=2;
		
		$sqlCmd="SELECT * FROM Members WHERE mName=:mname AND mTypeID=:cType";
		
		$prepQuery= $conn->prepare($sqlCmd);
		$prepQuery->bindParam(":mname",$cName, PDO::PARAM_STR);
		$prepQuery->bindParam(":cType",$clientType, PDO::PARAM_INT);
		$prepQuery->execute();
		$result = $prepQuery->fetchAll();
		
		
		
		/*
		
		if (!empty ($result))
		{
			echo "Client Found </br>";
		}
		else
		{
			echo"Client Not Found </br>";
		}*/
		
		/*
		print_r($result);
		
		foreach ($result as $oneRec)
		{
			$mID = $oneRec["mID"];
			echo $mID;
		}
		
		return $mID;
		*/
		
		return $result;
	}
	
	function displayClients($conn, $arr, $arg)
	{
		$tClient = new Client();
		$tClient->header();
		
		switch ($arg)
		{
			case 'name':
				{
					foreach ($arr as $oneRec)
					{
						$tObj = new Client();
						$tObj = self::fillObject($oneRec);
						echo $tObj;
					}
				}break;
			case 'all':
				{
					foreach ($arr as $oneRec)
					{
						echo $oneRec;
					}
				}break;
		}
			
		
		$tClient->footer();
	}
	
	function listAllClients($conn)
	{
		
		
		
		$sqlQuery="SELECT mID FROM Clients";
		
		$arrAllClientsID = $conn->query($sqlQuery);
		
		
		
		$counter=0;
		$clientsList="";
		

		
		
		$clientType=2;
		foreach ($arrAllClientsID as $oneRec)
		{
			
			
			$mid = $oneRec["mID"];
			
			//$mid=1;
			$sqlCmd="SELECT * FROM Members WHERE mID=:mid AND mTypeID=:cType";
			$prepQuery = $conn->prepare($sqlCmd);
			$prepQuery->bindParam(":mid",$mid, PDO::PARAM_INT);
			$prepQuery->bindParam(":cType",$clientType, PDO::PARAM_INT);
			$prepQuery->execute();
			
			$oneClient = $prepQuery->fetchAll();
			
			
			
			//print_r($oneClient); //This stament is for verifya the content of the array
			
			
			/*This stament call the function fillObject to create one client
			 *for each iteration of the forech loop
			 *The porpose is fill the temporary object client and return this object
			 *to fill and array of objects of clients 
			 */
			
			$tObj= self::fillObject($oneClient[0]); 
			

			$clientsList[$counter++]=$tObj; //Array that containt all the clients 
			

			
		}
		
		
		
		return $clientsList;
		
	}
	
	//Function that create an object of client in order to be
	//used from the caller function  for different porpose
	function fillObject($tClient)
	{
		$tObjC = new Client();
		
		$tObjC->setMID($tClient["mID"]);
		$tObjC->setMName($tClient["mName"]);
		$tObjC->setAddress($tClient["address"]);
		$tObjC->setMTypeID($tClient["mTypeID"]);
		$tObjC->setCity($tClient["city"]);
		$tObjC->setState($tClient["state"]);
		$tObjC->setPhone($tClient["phone"]);
		$tObjC->setEmail($tClient["email"]);
		$tObjC->setPassword($tClient["password"]);
	
	
		return $tObjC;
	}
	
	
	
	
	
}





?>