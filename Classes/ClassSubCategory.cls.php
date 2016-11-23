<?php
class SubCategory{
	private $subCatID;
	private $subCatName;
	private $categoryID;
	
	//getters
	function getSubCatID(){return $this->subCatID;}
	function getSubCatName(){return $this->subCatName;}
	function getCategoryID(){return $this->categoryID;}
	
	
	//setters
	function setSubCatID($subCatID){$this->subCatID= $subCatID;}
	function setSubCatName($subCatName){$this->subCatName= $subCatName;}	
	function setCategoryID($categoryID){$this->categoryID= $categoryID;}
	
	
	//default constructor
	function __construct($subCatID= null, $subCatName=null, $categoryID=null)
	{
		$this-> subCatID=$subCatID;
		$this-> subCatName=$subCatName;
		$this-> categoryID=$categoryID;
	}
}

?>