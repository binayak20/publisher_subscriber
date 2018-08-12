<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.imagedao.php';

/*
	Image Bussiness 
*/
Class ImageBAO{

	private $_DB;
	private $_ImageDAO;
	
	function ImageBAO(){

		$this->_ImageDAO = new ImageDAO();

	}

	public function addImage($ImageFile){

		$Result = new Result();	
		$Result = $this->_ImageDAO->addImage($ImageFile);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in Image.addImage()");		

		return $Result;
	}

	public function getAllImage(){
		$Result = new Result();	
		$Result = $this->_ImageDAO->getAllImage();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in Image.getAllImage()");		

		return $Result;
	}
	public function downloadImage($Image){
		$Result = new Result();	
		$Result = $this->_ImageDAO->downloadImage($Image);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in Image.downloadImage()");		

		return $Result;
	}

}
echo '<br> log:: exit the class.imagebao.php';
?>