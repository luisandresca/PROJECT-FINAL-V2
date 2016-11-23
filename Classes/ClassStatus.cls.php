<?php
class status{
	private $statusID;
	private $state;
	
	//setters
	function setStatusID($statusID){$this->statusID = $statusID;}
	function setState($state){$this->state=$state;}
	
	//getters
	function getStatusID(){return $this->statusID;}
	function getState(){return $this->state;}
	
	//Constructor
	function __construct($statusID=null, $state=null)
	{
		$this->statusID=$statusID;
		$this->state=$state;
	}
	
}

?>