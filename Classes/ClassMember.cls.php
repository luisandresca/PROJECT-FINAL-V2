<?php
class Member{
	private $mID;
	private $mName;
	private $address;
	private $mTypeID;
	private $city;
	private $state;
	private $phone;
	private $email;
	private $password;
	
	//Default contructor
	function __construct($mID =null, $mName =null, $address=null, $mTypeID=null, $city=null, $state=null, $phone=null, $email=null, $password=null)
	{
		$this->mID = $mID;
		$this->mName =$mName;
		$this->address=$address;
		$this->mTypeID=$mTypeID;
		$this->city=$city;
		$this->state=$state;
		$this->phone=$phone;
		$this->email=$email;
		$this->password=$password;
	}
	
	
	//Properties
	//Setters
	function setMID($mID){ $this->mID = $mID;}
	function setMName($mName){$this->mName = $mName;}
	function setAddress($address){$this->address = $address;}
	function setMTypeID($mTypeID){ $this->mTypeID = $mTypeID;}
	function setCity ($city){$this->city = $city;}
	function setState($state){$this->state = $state;}
	function setPhone($phone){$this->phone =$phone;}
	function setEmail($email){$this->email =$email;}
	function setPassword($password){$this->password=$password;}
	
	//Getters
	function getMID() {return $this->mID;}
	function getMName() {return $this->mName;}
	function getAddress() {return $this->address;}
	function getMTypeID() {return  $this->mTypeID;}
	function getCity(){return $this->city;}
	function getState(){return $this->state;}
	function getPhone(){return $this->phone;}
	function getEmail(){return $this->email;}
	function getPassword(){return $this->password;}
	
	
	//function __call($methodName,$arg){}
	
	/*function addUser($conn){}
	function updateUser($conn){}
	function findUserById($conn){}
	function findUserByName($conn){}
	function delete($conn){}
	function validate($conn){}
	*/
	
}
?>