<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class SubcategoryDAO{

	private $_DB;
	private $_Subcategory;
	private $_NewPublisher;

	function SubcategoryDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Subcategory = new Subcategory();
		$this->_NewPublisher = new NewPublisher();

	}

	// get all the Subcategory from the database using the database query
	public function getAllSubcategory($ID,$Ins_ID){

		$SubcategoryList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_child_cat WHERE UserID = '".$ID."' 
			                         AND InstituteID ='".$Ins_ID."' AND ParentID != '0' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setUserID ( $row['UserID']);
		    $this->_Subcategory->setInstituteID ( $row['InstituteID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setParentID( $row['ParentID'] );


		    $SubcategoryList[]=$this->_Subcategory;   
		}
		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

	public function getSubcategory(){
		$SubcategoryList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_child_cat ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setUserID ( $row['UserID']);
		    $this->_Subcategory->setInstituteID ( $row['InstituteID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setParentID( $row['ParentID'] );


		    $SubcategoryList[]=$this->_Subcategory;   
		}
		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

	public function getGroupNameFromcatId($ID){

		$this->_DB->doQuery("SELECT * FROM tbl_child_cat Where 	CatID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Name'];
	}

	public function getImageFromcatId($ID){
		$this->_DB->doQuery("SELECT * FROM tbl_child_cat Where 	CatID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Image'];
	}

	public function getPublisherCount($Id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con,"SELECT count(*) as total FROM tbl_new_publisher Where InstituteID = '".$Id."' ");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];		
	}

	public function getAllSubscriberCount($id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con,"SELECT count(*) as total FROM tbl_add_subscriber Where InstituteID = '".$id."' ");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];		
	}
	public function getPublisgerFromCatID($id)
	{
		$this->_DB->doQuery("SELECT u.* FROM tbl_user as u,tbl_child_cat as c,tbl_new_publisher as p Where 	c.CatID = '".$id."' AND c.CatID = p.CategoryID AND p.PublisherID=u.ID ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		if (sizeof($rows) == 0) {
			$None = "No Publisher Here";
			return $None;
		}
		else
		{
			for ($i=0; $i<sizeof($rows); $i++)
			{
				$row = $rows[$i];
			}
			return $row['FirstName']." ".$row['LastName'];
	    }
	}

	public function getAllSubcategoryWithRoot($ID,$Ins_ID){
		$SubcategoryList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_child_cat WHERE UserID = '".$ID."' 
			                         AND InstituteID ='".$Ins_ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setUserID ( $row['UserID']);
		    $this->_Subcategory->setInstituteID ( $row['InstituteID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setParentID( $row['ParentID'] );


		    $SubcategoryList[]=$this->_Subcategory;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

	public function getInstituteSubcategory($Ins_ID){

		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_child_cat WHERE InstituteID = '".$Ins_ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setInstituteID ( $row['InstituteID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setParentID( $row['ParentID'] );
		    $this->_Subcategory->setImage( $row['Image'] );


		    $SubcategoryList[]=$this->_Subcategory;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}
	public function getPublisherSubcategory($ID){
		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT c.* FROM tbl_child_cat c, tbl_new_publisher p WHERE p.PublisherID = '".$ID."' and p.CategoryID = c.CatID");
		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();
		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setInstituteID( $row['InstituteID'] );
		    $this->_Subcategory->setImage( $row['Image'] );
		 
		    $SubcategoryList[]=$this->_Subcategory;   
		}

		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

	public function getAllSubscriber($ID){
		$SubscriberList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_add_subscriber as ads,tbl_new_publisher as np WHERE 
			ads.CategoryID = np.CategoryID AND np.PublisherID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_AddSubscriber = new AddSubscriber();

		    $this->_AddSubscriber->setInstituteID ( $row['InstituteID']);
		    $this->_AddSubscriber->setCategoryID( $row['CategoryID'] );
		    $this->_AddSubscriber->setSubscriberID( $row['SubscriberID'] );
		 
		    $SubscriberList[]=$this->_AddSubscriber;   
		}

		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubscriberList);

		return $Result;
	}

	public function getAllSubscriberFromInstitution($ID){
		$SubscriberList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_add_subscriber WHERE InstituteID = '".$ID."' ");
		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_AddSubscriber = new AddSubscriber();

		    $this->_AddSubscriber->setInstituteID ( $row['InstituteID']);
		    $this->_AddSubscriber->setCategoryID( $row['CategoryID'] );
		    $this->_AddSubscriber->setSubscriberID( $row['SubscriberID'] );
		 
		    $SubscriberList[]=$this->_AddSubscriber;   
		}

		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubscriberList);

		return $Result;
	}

	public function getAllSubscriberOfCategory($ID,$catId){
		$SubscriberList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_add_subscriber as ads,tbl_new_publisher as np WHERE 
			ads.CategoryID = np.CategoryID AND np.PublisherID = '".$ID."' AND ads.CategoryID = '".$catId."' ");
		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_AddSubscriber = new AddSubscriber();

		    $this->_AddSubscriber->setInstituteID ( $row['InstituteID']);
		    $this->_AddSubscriber->setCategoryID( $row['CategoryID'] );
		    $this->_AddSubscriber->setSubscriberID( $row['SubscriberID'] );
		 
		    $SubscriberList[]=$this->_AddSubscriber;   
		}

		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubscriberList);

		return $Result;
	}


	// get all the Permissions from the database using the database query
	public function getAllPermissions(){

		$PermissionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_Permission");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Permission = new Permission();

		    $this->_Permission->setID ( $row['ID']);
		    $this->_Permission->setName( $row['Name'] );
		    $this->_Permission->setCategory( $row['Category'] );

		    $PermissionList[]=$this->_Permission;
   
		}

	
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($PermissionList);

		return $Result;
	}

		//read an Role object based on its id form Role object
	public function readSubcategory($Subcategory){
		
		$SQL = "SELECT * FROM tbl_child_cat WHERE CatID='".$Subcategory->getCatID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Role from the database
		$row = $this->_DB->getTopRow();

		$this->Subcategory = new Subcategory();

		//preparing the Role object
	    $this->_Subcategory->setCatID ( $row['CatID']);
	    $this->_Subcategory->setName( $row['Name'] );



	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Subcategory);

		return $Result;
	}
	//update an Role object based on its 
	public function updateSubcategory($Subcategory){

		$SQL = "UPDATE tbl_child_cat SET 

			Name  = '".$Subcategory->getName()."',
			Image = '".$Subcategory->getImage()."'

			 WHERE CatID='".$Subcategory->getCatID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	public function getSubscriberSubcategory($ID){
		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT c.Name,c.CatID FROM tbl_child_cat c,tbl_add_subscriber s WHERE 
			s.SubscriberID = '".$ID."' and s.CategoryID = c.CatID");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setName( $row['Name'] );

		    $SubcategoryList[]=$this->_Subcategory;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

}

//echo '<br> log:: exit the class.subcategorydao.php';

?>