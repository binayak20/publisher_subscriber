<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class InstitutionDAO{

	private $_DB;
	private $_Institution;

	function InstitutionDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Institution = new Institution();
	}

	public function createInstitution($Institution){

		$ID          = $Institution->getID();
		$UserID      = $Institution->getUserID();
		$Name        = $Institution->getName();
		$Address     = $Institution->getAddress();
		$Description = $Institution->getDescription();
		$Image       = $Institution->getImage();

		$SQL = "INSERT INTO tbl_institution(ID,UserID,Name,Address,Description,Image) VALUES('$ID','$UserID','$Name','$Address','$Description','$Image')";
		//$SQL = "INSERT INTO tbl_child_cat(CatID,UserID,InstituteID,Name,ParentID) VALUES('1','$UserID','$Name','$Address')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function getAllInstitution(){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);
		    $this->_Institution->setDescription( $row['Description']);
		    $this->_Institution->setImage( $row['Image']);

		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}

	public function getInstitutionByID($InsId){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution WHERE ID = '".$InsId."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);
		    $this->_Institution->setDescription( $row['Description']);
		    $this->_Institution->setImage( $row['Image']);

		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}

	public function getOrganizerImage($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_profileimage Where UserID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Image'];
	}

	public function getInstituteNameFromID($ID){

		$this->_DB->doQuery("SELECT * FROM tbl_institution Where ID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Name'];
	}

	public function getInstituteLocation($ID){

		$this->_DB->doQuery("SELECT * FROM tbl_institution Where ID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Address'];
	}

	public function getOrganizerName($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['FirstName']." ".$row['LastName'];
	}

	public function getPublisherRequestCount($id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con,"SELECT count(*) as total FROM tbl_request_pub as r, tbl_institution as ins  Where r.InstituteID = ins.ID AND r.OrganizerID = ins.UserID AND ins.UserID = '".$id."' AND r.Status = 2 ");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];
	}

	public function getInstitution($ID){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution WHERE UserID = '".$ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    
		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);
		    $this->_Institution->setDescription( $row['Description']);
		    $this->_Institution->setImage( $row['Image']);


		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}

	public function getInstituteAsRootParent($ID,$Ins_ID){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution WHERE UserID = '".$ID."' AND ID ='".$Ins_ID."' ");
		
			                         

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    
		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);


		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}
	
	public function createSubcategory($Subcategory){

		$CatID       = $Subcategory->getCatID();
		$UserID      = $Subcategory->getUserID();
		$InstituteID = $Subcategory->getInstituteID();
		$Name        = $Subcategory->getName();
		$ParentID    = $Subcategory->getParentID();
		$Image       = $Subcategory->getImage();


		$SQL = "INSERT INTO tbl_child_cat(CatID,UserID,InstituteID,Name,ParentID,Image) VALUES('$CatID','$UserID','$InstituteID','$Name','$ParentID','$Image')";


		$SQL = $this->_DB->doQuery($SQL);		

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function createDefaultPublisher($NewPublisher){

		$InstituteID = $NewPublisher->getInstituteID();	
		$CategoryID  = $NewPublisher->getCategoryID();
		$PublisherID = $NewPublisher->getPublisherID();

		$SQL = "INSERT INTO tbl_new_publisher(InstituteID,CategoryID,PublisherID) VALUES ('$InstituteID','$CategoryID','$PublisherID')";


		$SQL = $this->_DB->doQuery($SQL);

		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	public function readInstitutionData($Institution){
		
		$SQL = "SELECT * FROM tbl_institution WHERE ID ='".$Institution->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		$this->_Institution = new Institution();

		//preparing the user object
	    $this->_Institution->setID ( $row['ID']);
	    $this->_Institution->setName ( $row['Name'] );    
	    $this->_Institution->setUserID ( $row['UserID'] );
	    $this->_Institution->setAddress( $row['Address'] );
	    $this->_Institution->setImage( $row['Image'] );
		   


	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Institution);

		return $Result;
	}

	public function updateInstitutionWithoutImage($Institution){
		$SQL = "UPDATE tbl_institution SET
		 
	    Name      = '".$Institution->getName()."',
		Address   = '".$Institution->getAddress()."'

		WHERE ID = '".$Institution->getID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	}

	public function updateInstitutionWithImage($Institution){
		$SQL = "UPDATE tbl_institution SET
		 
	    Name      = '".$Institution->getName()."',
		Address   = '".$Institution->getAddress()."',
		Image     = '".$Institution->getImage()."'

		WHERE ID = '".$Institution->getID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	}
	
	public function deleteInstitution($Institution){
		$SQL = "DELETE from tbl_institution where ID ='".$Institution->getID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deleteCateory($Subcategory){
		$SQL = "DELETE from tbl_child_cat where InstituteID ='".$Subcategory->getInstituteID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deletePublisher($NewPublisher){
		$SQL = "DELETE from tbl_new_publisher where InstituteID ='".$NewPublisher->getInstituteID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deleteSubscriber($AddSubscriber){
		$SQL = "DELETE from tbl_add_subscriber where InstituteID ='".$AddSubscriber->getInstituteID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}
	
}

//echo '<br> log:: exit the class.institutiondao.php';

?>