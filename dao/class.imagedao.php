<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class ImageDAO{

	private $_DB;
	private $_ImageFile;

	function ImageDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_ImageFile = new ImageFile();
	}

	public function addImage($ImageFile){

		$ID    = $ImageFile->getID();	
		$Name  = $ImageFile->getName();
		$Image = $ImageFile->getImage();
	
		$SQL = "INSERT INTO tbl_image(ID,Name,Image) VALUES('$ID','$Name','$Image')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function getAllImage(){
		$ImageList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_image");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_ImageFile = new ImageFile();

		    $this->_ImageFile->setID ( $row['ID']);
		    $this->_ImageFile->setName ( $row['Name']);
		    $this->_ImageFile->setImage( $row['Image'] );
		    

		    $ImageList[] = $this->_ImageFile;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($ImageList);

		return $Result;
	}

	public function downloadImage($Image){
		$ImageList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_image where Image = '$Image' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_ImageFile = new ImageFile();

		    $this->_ImageFile->setID ( $row['ID']);
		    $this->_ImageFile->setName ( $row['Name']);
		    $this->_ImageFile->setImage( $row['Image'] );
		    

		    $ImageList[] = $this->_ImageFile;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($ImageList);

		return $Result;
	}
	
}
//echo '<br> log:: exit the class.imagedao.php';
?>