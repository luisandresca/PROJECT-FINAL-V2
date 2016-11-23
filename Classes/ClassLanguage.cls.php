<?php
class Language{
	private $languageID;
	private $languageName;

	//getters
	function getLanguageName(){return $this->languageName;}
	function getLanguageID(){return $this->languageID;}
	
	//setters
	function setLanguageName($languageName){$this->languageName= $languageName;}
	function setLanguageID($languageID){$this->languageID= $languageID;}
	
	//default constructor
	function __construct($languageName= null, $languageID=null)
	{
		$this-> languageName=$languageName;
		$this-> languageID=$languageID;
	}
}

?>