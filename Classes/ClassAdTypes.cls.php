<?php
class adTypes{
	private $adTypeID;
	private $description;
	private $duration;
	private $price;
	
	//getters
	function getAdTypeID(){return $this->adTypeID;}
	function getDescriptionID(){return $this->description;}
	function getDuration(){return $this->duration;}
	function getPrice(){return $this->price;}
	
	//setters
	function setAdTypeID($adTypeID){$this->adTypeID= $adTypeID;}
	function setDescription($description){$this->description=$description;}
	function setDuration($duration){$this->duration=$duration;}
	function setPrice($price){$this->price=$price;}
	
    //Constructor
    function __construct($adTypeID= null, $description=null, $duration=null, $price=null)
    {
    	$this->adTypeID= $adTypeID;
    	$this->description=$description;
    	$this->duration=$duration;
    	$this->price=$price;	
    }
	
    
	
	
	
	
}
?>