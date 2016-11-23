<?php
include 'ClassMember.cls.php';
include 'ClassAdvertising.cls.php';

class Client extends Member{
	

	
	/*
      I create this function to over load the method add.
	  However i consider that is better to work directly with the 
	  the name of the thing that we are going to add
	  Exp: createAdd, createUser.
	
	/*
	function __call($methodName, $arg)
	{
		switch ($methodName)
		{
			case 'add':
				{
					//overload function to insert an user
					if (count($arg)=== 1)
					{
						
						$conn = $arg[0]; //First argument is the connection
						$name=$this->getMName();
						$address=$this->getAddress();
						$birthdate =$this->getAddress();
						$mTypeId = $this->getMTypeID();
						$city =$this->getCity();
						$state = $this->getState();
						$phone =$this->getPhone();
						$email = $this->getEmail();
						$password = $this->getPassword();
		
						$sqlCmd = "INSERT INTO members (mName, address, mTypeID, city, state, phone, email, password)
		           					VALUES ('".$name."','".$address."', $mTypeId,'".$city."', '".$state."', '".$phone."', '".$email."', '".$password."')";
						
						$result = $conn -> exec($sqlCmd);
						
					}
					elseif (count($arg)=== 2)
					{
						//overload function to insert an add
						$conn = $arg[0]; //First argument is the connection
						
						
						echo "add post or ads <br/>";
						$result = true;
					}
				}break;
		}
		echo "".count($arg)."";

		return $result;
	}
	*/
	
	function createClient($conn){
		
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
		           INSERT INTO  Clients (mID) VALUES (@A) ;
		         COMMIT;
			     ";		
		
		$result = $conn -> exec($sqlCmd);
		
		
		
		return $result;
		
	}

	/*
	function deleteClient($conn)
	{
	
		$email=$this->getEmail();
		$pass=$this->getPassword();
		
		echo "$email </br> $pass";
		
		$sqlCmd= " START TRANSACTION;
		SET @email='".$email."';
		SET @pass='".$pass."';
	
	
		SELECT @A:=mID FROM members WHERE email=@email AND password=@pass;
		DELETE FROM ads WHERE mID = @A;
		DELETE FROM clients WHERE mID = @A;
		DELETE FROM members WHERE mID = @A;
	
		COMMIT;
		";
	
		
		
		$result = $conn -> exec($sqlCmd);
		return $result;
	
	echo "HOLA ENTRE";
	
		
	
	}
	
	*/
	
	function createNewAdd($conn, $subCatID, $regDate, $statusID, $adTypeID, $description)
	{
		$mID = $this->getMID();
		$tAd= new ads(null,$mID, $subCatID, $regDate, null, $statusID, $adTypeID, $description);
		$tAd->calculateExpDate($conn);
		$expDate =$tAd->getExpDate();
		
		
		
		
		
	/////Test temporal
	//$mID=2;
	
	
		$sqlCmd = "INSERT INTO ads (mID, subCatID, regDate, expDate, statusID, adTypeID, description)
		VALUES ($mID,$subCatID, '".$regDate."','".$expDate."',$statusID, $adTypeID, '".$description."')";
	
		
		$result = $conn -> exec($sqlCmd);
	
	
	
		return $result;
	}
	
	//funtion to change the status of the ad
	function changeAdStatus($conn,$statusID,$adID )
	{
		$sqlCmd = "UPDATE ads SET statusID=".$statusID." WHERE adID = $adID";
		
		$result = $conn -> exec($sqlCmd);
		
		
	}
	
	
	
	//This function is on the classAdmin beacuse the administrator search for an user
/*	
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
			$tObj = new User();
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
	
*/	
	
	
	
	
	
	/*
	function __toString(){
		$display="<table border='1'>
                  <tr><td><strong>User ID</strong></td><td>".$this->getMID()."</td></tr>
				  <tr><td><strong>Name</strong></td><td>".$this->getMName()."</td></tr>
                  <tr><td><strong>Address</strong></td><td>".$this->getAddress()."</td></tr>
                  <tr><td><strong>City</strong></td><td>".$this->getCity()."</td></tr>
                  <tr><td><strong>State</strong></td><td>".$this->getState()."</td></tr>
                  <tr><td><strong>Phone</strong></td><td>".$this->getPhone()."</td></tr>
                  <tr><td><strong>Email</strong></td><td>".$this->getEmail()."</td></tr>
                  <tr><td><strong>Password</strong></td><td>".$this->getPassword()."</td></tr>
				  
				  </table>";
		return $display;
	}
	*/
	
	
	function header()
	{
		$display="<table border='1'>
				  <tr><td><strong>User ID</strong></td>
		          <td><strong>Name</strong></td>
		          <td><strong>Address</strong></td>
		          <td><strong>City</strong></td>
		          <td><strong>State</strong></td>
		          <td><strong>Phone</strong></td>
		          <td><strong>Email</strong></td>
		          <td><strong>Password</strong></td></tr>";
		echo $display;
	}
	
	
	function __toString(){
		$display="<tr><td>".$this->getMID()."</td>
		              <td>".$this->getMName()."</td>
		              <td>".$this->getAddress()."</td>
		              <td>".$this->getCity()."</td>
		              <td>".$this->getState()."</td>
		              <td>".$this->getPhone()."</td>
		              <td>".$this->getEmail()."</td>
		              <td>".$this->getPassword()."</td></tr>";
	
	
		return $display;
	}
	
	function footer()
	{
		echo "</table>";
	
	}
	
	
	function updateInfo($mName, $address, $city, $state, $phone, $email, $password, $mid, $conn)
	{
		$sqlCmd = "UPDATE `dbads`.`members` SET `mName` = '".$mName."', `address` = '".$address."', 
				          `city` = '".$city."', `state` = '".$state."', `phone` = '".$phone."', 
				          `email` = '".$email."', `password` = '".$password."' 
		           WHERE `members`.`mID` = $mid";
		$result = $conn -> exec($sqlCmd);
		return $result;
	}
	
	function displayAllAdds($conn, $cID)
	{
		$sqlCmd = "SELECT ads.adID, ads.description as adDesc, ads.regDate, ads.expDate, 
		                  pictures.pictureID, pictures.location, status.state, 
		                  categories.categoryID, categories.categoryName,
				          adTypes.description
				   FROM ads
				   JOIN pictures
				   ON pictures.adID = ads.adID
				   JOIN status
				   ON status.statusID = ads.statusID
				   JOIN subcategories
				   ON subcategories.subCatID = ads.subCatID
				   JOIN categories
				   ON  categories.categoryID = subcategories.categoryID
				   JOIN adTypes
				   ON adTypes.adTypeID = ads.adTypeID
				   WHERE ads.mID=:cid";
		
		$prepQuery = $conn ->prepare($sqlCmd);
		$prepQuery->bindParam(":cid",$cID, PDO::PARAM_INT);
		$prepQuery->execute();
		$resulAds= $prepQuery->fetchAll();
		
		//print_r($prepQuery);
		
		echo "<table border='1'>
			  <tr><td><strong>Ad ID</strong></td>
		      <td><strong>Description</strong></td>
		      <td><strong>Reg Date</strong></td>
		      <td><strong>Exp Date</strong></td>
		      <td><strong>Category Name</strong></td>
		      <td><strong>State</strong></td>
		      <td><strong>Ad Type</strong></td>
		      <td><strong>Picture</strong></td></tr>";
		foreach ($resulAds as $oneRec)
		{
			$display = "<tr>
					    <td>".$oneRec["adID"]."</td>
					    <td>".$oneRec["adDesc"]."</td>
					    <td>".$oneRec["regDate"]."</td>
					    <td>".$oneRec["expDate"]."</td>
					    <td>".$oneRec["categoryName"]."</td>
					    <td>".$oneRec["state"]."</td>
					    <td>".$oneRec["description"]."</td>
					    </tr>";
			echo $display;
		}
		
		echo "</table>";
		
		
		
	}
	
	function clientPayments($conn, $cID)
	{
		$sqlCmd = "SELECT ads.adID, adTypes.description, adTypes.price 
				   FROM ads
				   JOIN adTypes
				   ON adTypes.adTypeID = ads.adTypeID 
				   JOIN members
				   ON ads.mID = members.mID
				   WHERE members.mID =:cid
				";
		$prepQuery = $conn ->prepare($sqlCmd);
		$prepQuery->bindParam(":cid",$cID, PDO::PARAM_INT);
		$prepQuery->execute();
		$resulAds= $prepQuery->fetchAll();
		
		echo "<table border='1'>
			  <tr><td><strong>Ad ID</strong></td>
		      <td><strong>Description</strong></td>
		      <td><strong>Total Payment</strong></td>
		      </tr>";
		
		foreach ($resulAds as $oneRec)
		{
			$display = "<tr>
					    <td>".$oneRec["adID"]."</td>
					    <td>".$oneRec["description"]."</td>
					    <td>".$oneRec["price"]."</td>
					    </tr>";
			echo $display;
		}
		
		
		$sqlCmd="SELECT SUM(adTypes.price) as total_payment
				 FROM ads
				 JOIN adTypes
			     ON adTypes.adTypeID = ads.adTypeID
			     JOIN members
				 ON ads.mID = members.mID
				 WHERE members.mID=:cid
				";
		$prepQuery2 = $conn ->prepare($sqlCmd);
		$prepQuery2->bindParam(":cid",$cID, PDO::PARAM_INT);
		$prepQuery2->execute();
		$resulTotal= $prepQuery2->fetchAll();
		
		foreach ($resulTotal as $oneRec)
		{
			echo "<tr><td colspan='2'><strong>Total</strong></td><td><strong>".$oneRec["total_payment"]."</strong></td></tr>";
		}
		
		
		
		
		
		echo "</table>";
		

		
		
		
	}
	
	
	//To do
	/*
	 DELETE AD
	 UPDATE AD
	 
	 DISPLAY ALL PAYMENTS RELATED TO THE USER
	 DYSPALY THE TOTAL OF PAYMENT RELATED TO THE CURRENT USER
	
	 
	 * 
	 * 
	 * 
	 */
	
}

?>


