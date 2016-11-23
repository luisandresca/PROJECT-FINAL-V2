<?php

include 'ClassAdTypes.cls.php';

class ads{
	//Atributes
	private $adID;
	private $mID;
	private $subCatID;
	private $regDate;
	private $expDate;
	private $statusID;
	private $adTypeID;
	private $description;
	
	//Getters
	function getAdID(){return $this->adID;}
	function getMID(){return $this->mID;}
	function getSubCatID(){return $this->subCatID;}
	function getRegDate(){return $this->regDate;}
	function getExpDate(){return $this->expDate;}
	function getStatusID(){return $this->statusID;}
	function getAdTypeID(){return $this->adTypeID;}
	function getDescription(){return $this->description;}
	
	
	//Setters
	function setAdID($adID){$this->adID = $adID;}
	function setMID($mID){$this->mID =$mID;}
	function setSubCatID($subCatID){$this->subCatID =$subCatID ;}
	function setRegDate($regDate){$this->regDate = $regDate;}
	function setExpDate($expDate){$this->expDate =$expDate ;}
	function setStatus($statusID){$this->statusID =$statusID ;}
	function setAdTypeID($adTypeID){$this->adTypeID =$adTypeID ;}
	function setDescription($description){$this->description =$description;}
	
	
	//Constructor
	function __construct($adID =null,$mID= null, $subCatID=null, $regDate=null, $expDate=null, $statusID=null, $adTypeID=null, $description=null)
	{
		$this-> adID= $adID;
		$this-> mID=$mID;
		$this-> subCatID=$subCatID;
		$this-> regDate=$regDate;
		$this-> expDate=$expDate;
		$this-> statusID=$statusID;
		$this-> adTypeID=$adTypeID;
		$this-> description=$description;
	}
	
	//funtion to calculate the expiration date of the ad
	function calculateExpDate($conn)
	{
		$adTypeID = $this->adTypeID;
		$query = "SELECT duration FROM adTypes WHERE adTypeID=:parameter1";
		$prepQuery = $conn->prepare($query);
		$prepQuery ->BindValue (":parameter1",$adTypeID,PDO::PARAM_INT);
		$prepQuery ->execute();
		$result = $prepQuery->fetchAll();
		
		if(count($result)>0)
		{
			
			$oneRec = $result[0];
			$this->expDate = date("Y/m/d", strtotime(date("/d")+$oneRec["duration"].' days'));
			
			
		}	
		
		
	}
	

	
	
	
	function __toString()
	{
		//To do   
	}
	
	
	
	
}
?>