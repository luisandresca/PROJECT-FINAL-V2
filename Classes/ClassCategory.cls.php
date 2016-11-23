<?php
class Category{
	
	private $categoryID;
	private $categoryName;
	private $languageID;
	
	//getters
	function getCategoryID(){return $this->categoryID;}
	function getCategoryName(){return $this->categoryName;}
	function getLanguageID(){return $this->languageID;}
	
	//setters
	function setCategoryID($categoryID){$this->categoryID= $categoryID;}
	function setCategoryName($categoryName){$this->categoryName= $categoryName;}
	function setLanguageID($languageID){$this->languageID= $languageID;}
	
	//default constructor
	function __construct($categoryID =null,$categoryName= null, $languageID=null)
	{
		$this-> categoryID= $categoryID;
		$this-> categoryName=$categoryName;
		$this-> languageID=$languageID;
	}
	
	
}

?>