<?php
class MTypes{
private $mTypeID;
	private $description;
	
	//getters
	function getMTypeID(){return $this->mTypeID;}
	function getDescription(){return $this->description;}
	
	//setters
	function setMTypeID($mTypeID){$this->mTypeID= $mTypeID;}
	function setDescription($description){$this->description= $description;}
	
	//default constructor
	function __construct($mTypeID= null, $description=null)
	{
		$this-> mTypeID=$mTypeID;
		$this-> description=$description;
	}
}

?>