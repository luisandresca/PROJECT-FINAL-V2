<?php
include 'ClassEmployee.cls.php';

class Admin extends Client
{
	//search user
	function searchUserByID($conn, $mID)
	{
		//sql stament
		$sqlCmd = "SELECT * FROM members WHERE mID=:p1";
		//prepare the sql stament
		$preQuery = $conn ->prepare($sqlCmd);
		//define the paramenter
		$preQuery -> BindValue(":p1",$mID,PDO::PARAM_INT);
	
		//execute the query
		$preQuery->execute();
	
		//get the result
		$result = $preQuery->fetchAll();
	
		if (count($result)>0)
		{
	
			$oneRec = $result[0];
			$tObj = new Client();
			$tObj->setMID($mID);
			$tObj->setMName($oneRec["mName"]);
			$tObj->setAddress($oneRec["address"]);
			$tObj->setMTypeID($oneRec["mTypeID"]);
			$tObj->setCity($oneRec["city"]);
			$tObj->setState($oneRec["state"]);
			$tObj->setPhone($oneRec["phone"]);
			$tObj->setEmail($oneRec["email"]);
			$tObj->setPassword($oneRec["password"]);
				
			return $tObj;
		}
		else
		{
			echo "The user id ".$mID." doesn't exist";
		}
			
	}
	
	//create employee
	function createEmployee($conn)
	{
		//$mID =$this->getMID();
		$name=$this->getMName();
		$address=$this->getAddress();
		$mTypeId = $this->getMTypeID();
		$city =$this->getCity();
		$state = $this->getState();
		$phone =$this->getPhone();
		$email = $this->getEmail();
		$password = $this->getPassword();
	
	
		$sqlCmd ="START TRANSACTION;
		           SET @name='".$name."';
		  		   SET @address='".$address."';
		           SET @mtyp=".$mTypeId.";
                   SET @city='".$city."';
		           SET @stat='".$state."';
		           SET @ph='".$phone."';
		           SET @email='".$email."';
		           SET @pass='".$password."';
	
		           INSERT INTO Members (mName, address, mTypeID, city, state, phone, email, password) VALUES (@name,@address,@mtyp, @city, @stat, @ph, @email, @pass);
		           SELECT @A:=mID FROM members WHERE email=@email AND password=@pass;
		           INSERT INTO  Employees (mID) VALUES (@A) ;
		         COMMIT;
			     ";
	
		$result = $conn -> exec($sqlCmd);
	
		return $result;
	
	}
	
	//delete employee
	function deleteEmployee($conn, $employeeEmail, $employeePass)
	{
		$sqlCmd= "Select mID FROM members WHERE email=:emailp AND password=:passp";
	
		$preQuery = $conn ->prepare($sqlCmd);
		$preQuery -> BindValue (":emailp",$employeeEmail,PDO::PARAM_STR);
		$preQuery -> bindParam (":passp",$employeePass, PDO::PARAM_STR);
		$preQuery -> execute();
		$result = $preQuery->fetchAll();
	
		$counterAds=0;
		$counterEmployee=0;
		$counterMember=0;
	
		foreach ($result as $oneRec)
		{
	
			$sqlCmd ="DELETE FROM employees WHERE mID = ".$oneRec["mID"].";";
			$result = $conn -> exec($sqlCmd);
			if (!empty($result)) { $counterEmployee++;}
	
	
			$sqlCmd ="DELETE FROM members WHERE mID = ".$oneRec["mID"].";";
			$result = $conn -> exec($sqlCmd);
			if (!empty($result)) { $counterMember++;}//Number of times that the employee is in the table member
	
	
		}
	
		echo "employee deleted =".$counterEmployee."</br>"; //number of times that the user is in table employee
		echo "Member deleted =".$counterMember."</br>"; //Number of times that the user is in the table member
	
	}
	
	
	
	//Display all employees
	function displayEmployees($conn, $arr, $arg)
	{
		$tEmp = new Employee();
		$tEmp->header();
	
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
			
	
		$tEmp->footer();
	}
	
	function listAllEmployees($conn)
	{
	
		$sqlQuery="SELECT mID FROM Employees";
	
		$arrAllEmpID = $conn->query($sqlQuery);
		
		$counter=0;
		$empList="";
	
	
	
	
		$empType=3;
		foreach ($arrAllEmpID as $oneRec)
		{
				
				
			$mid = $oneRec["mID"];
				
			//$mid=1;
			$sqlCmd="SELECT * FROM Members WHERE mID=:mid AND mTypeID=:cType";
			$prepQuery = $conn->prepare($sqlCmd);
			$prepQuery->bindParam(":mid",$mid, PDO::PARAM_INT);
			$prepQuery->bindParam(":cType",$empType, PDO::PARAM_INT);
			$prepQuery->execute();
				
			$oneEmp = $prepQuery->fetchAll();
				
				
				
			//print_r($oneClient); //This stament is for verifya the content of the array
				
				 	
			/*This stament call the function fillObject to create one client
			 *for each iteration of the forech loop
			 *The porpose is fill the temporary object client and return this object
			 *to fill and array of objects of clients
			 */
				
			$tObj= self::fillObject($oneEmp[0]);
				
	
			$empList[$counter++]=$tObj; //Array that containt all the clients
				
		}
		return $empList;
	
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