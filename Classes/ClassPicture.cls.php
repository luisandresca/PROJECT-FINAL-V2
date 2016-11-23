<?php
class Picture{
	private $pictureID;
	private $adID;
	private $title;
	private $location;
	private $adTypeID;
	
	//getters
	function getPictureID(){return $this->pictureID;}
	function getadID(){return $this->adID;}
	function getTitle(){return $this->title;}
	function getLocation(){return $this->location;}
	function getadTypeID(){return $this->adTypeID;}
	
	
	//setters
	function setPictureID($pictureID){$this->pictureID= $pictureID;}
	function setAdID($adID){$this->adID= $adID;}
	function setTitle($title){$this->title= $title;}
	function setLocation($location){$this->location= $location;}
	function setAdTypeID($adTypeID){$this->adTypeID= $adTypeID;}
	
	
	//default constructor
	function __construct($pictureID= null, $adID=null,$title=null, $location=null, $adTypeID=null )
	{
		$this-> pictureID=$pictureID;
		$this-> adID=$adID;
		$this-> title=$title;
		$this-> location=$location;
		$this-> adTypeID=$adTypeID;
	}
}

?>