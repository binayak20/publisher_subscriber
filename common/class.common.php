<?php

/*All the common Model classes are listed here*/
class Result{

    private $_IsSuccess=0;
    private $_ResultObject;

    public function setIsSuccess($IsSuccess){
        $this->_IsSuccess = $IsSuccess;
    }

    public function getIsSuccess(){

        return $this->_IsSuccess;
    }

    public function setResultObject($ResultObject){
        $this->_ResultObject = $ResultObject;
    }

    public function getResultObject(){
        
        return $this->_ResultObject;
    }

}

class Category{
    private $_ID;
    private $_Name;

    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }
    
    public function setName( $Name ) {
        $this->_Name = $Name;
    }

    public function getName() {
        return $this->_Name;
    }  
}
class Institution{
    private $_ID;
    private $_UserID;
    private $_Name;
    private $_Address;
    private $_Description;
    private $_Image;

    public function setID($ID){
        $this->_ID = $ID;
    }

    public function getID(){
        return $this->_ID;
    }

    public function setName($Name){
        $this->_Name = $Name;
    }

    public function getName(){
        return $this->_Name;
    }

    public function setUserID($UserID){
        $this->_UserID = $UserID;
    }

    public function getUserID(){
        return $this->_UserID;
    }

    public function setAddress($Address){
        $this->_Address = $Address;
    }

    public function getAddress(){
        return $this->_Address;
    }

    public function setDescription($Description){
        $this->_Description = $Description;
    }

    public function getDescription(){
        return $this->_Description;
    }

    public function setImage($Image){
        $this->_Image = $Image;
    }

    public function getImage(){
        return $this->_Image;
    }
}
class User{
    private $_ID;
    private $_FirstName;
    private $_LastName;
    private $_Email;
    private $_Password;
    private $_Address;
   // private $_Oldpass;
    //private $_Newpass;

    public function setID($ID){
        $this->_ID = $ID;
    }

    public function getID(){
        return $this->_ID;
    }

    public function setFirstName($FirstName){
        $this->_FirstName = $FirstName;
    }

    public function getFirstName(){
        return $this->_FirstName;
    }

    public function setLastName($LastName){
        $this->_LastName = $LastName;
    }

    public function getLastName(){
        return $this->_LastName;
    }

    public function setEmail($Email){
        $this->_Email = $Email;
    }

    public function getEmail(){
        return $this->_Email;
    }

    public function setPassword($Password){
        $this->_Password = $Password;
    }

    public function getPassword(){
        return $this->_Password;
    }

    public function setAddress($Address){
        $this->_Address = $Address;
    }

    public function getAddress(){
        return $this->_Address;
    }

   /* public function setOldPass($Oldpass){
        $this->_Oldpass = $Oldpass;
    }

    public function getOldPass(){
        return $this->_Oldpass;
    }

    public function setNewPass($Newpass){
        $this->_Newpass = $Newpass;
    }

    public function getNewPass(){
        return $this->_Newpass;
    }*/

}

class UserProfileImage{
    private $_UserID;
    private $_Image;

    public function setUserID ( $UserID ) {
        $this->_UserID = $UserID;
    }

    public function getUserID () {
        return $this->_UserID;
    }

    public function setImage ( $Image ) {
        $this->_Image = $Image;
    }

    public function getImage () {
        return $this->_Image;
    }

}

class FavouriteNotice{
    
    private $_FNoticeID;
    private $_SubscriberID;

    public function setFavouriteNoticeID ( $FNoticeID ) {
        $this->_FNoticeID = $FNoticeID;
    }

    public function getFavouriteNoticeID () {
        return $this->_FNoticeID;
    }

    public function setSubscriberID ( $SubscriberID ) {
        $this->_SubscriberID = $SubscriberID;
    }

    public function getSubscriberID () {
        return $this->_SubscriberID;
    }
}

class Subcategory {
    private $_CatID;
    private $_UserID;
    private $_InstituteID;
    private $_Name;
    private $_ParentID;
    private $_Image;

    public function setCatID ( $CatID ) {
        $this->_CatID = $CatID;
    }

    public function getCatID () {
        return $this->_CatID;
    }

    public function setUserID ( $UserID ) {
        $this->_UserID = $UserID;
    }

    public function getUserID () {
        return $this->_UserID;
    }

    public function setInstituteID ( $InstituteID ) {
        $this->_InstituteID = $InstituteID;
    }

    public function getInstituteID () {
        return $this->_InstituteID;
    }
    
    public function setName( $Name ) {
        $this->_Name = $Name;
    }

    public function getName() {
        return $this->_Name;
    }

    public function setParentID ( $ParentID ) {
        $this->_ParentID = $ParentID;
    }

    public function getParentID () {
        return $this->_ParentID;
    }
    
    public function setImage($Image){
            $this->_Image = $Image;
    }

    public function getImage(){
        return $this->_Image;
    }
}
class Subscriber{
    private $_ID;
    private $_Category;
    private $_Institution;
    private $_Username;
    private $_Password;

    public function setID($ID){
        $this->_ID = $ID;
    }
    public function getID(){
        return $this->_ID;
    }
    public function setCategory($Category){
        $this->_Category = $Category;
    }
    public function getCategory(){
        return $this->_Category;
    }
    public function setInstitution($Institution){
        $this->_Institution = $Institution;
    }
    public function getInstitution(){
        return $this->_Institution;
    }
    public function setUsername($Username){
        $this->_Username = $Username;
    }
    public function getUsername(){
        return $this->_Username;
    }
    public function setPassword($Password){
        $this->_Password = $Password;
    }
    public function getPassword(){
        return $this->_Password;
    }

}
class Notice{
    private $_ID;
    private $_ChildCatID;
    private $_PubCatID;
    private $_PublisherID;
    private $_Notice;
    private $_Image;
    private $_Status;

    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }

    public function setChildCatID($ChildCatID){
        $this->_ChildCatID = $ChildCatID;
    } 

    public function getChildCatID(){
        return $this->_ChildCatID;
    } 

    public function setPubCatID($PubCatID){
        $this->_PubCatID = $PubCatID;
    } 

    public function getPubCatID(){
        return $this->_PubCatID;
    }

    public function setPublisherID($PublisherID){
        $this->_PublisherID = $PublisherID;
    } 

    public function getPublisherID(){
        return $this->_PublisherID;
    } 

    public function setNotice($Notice){
        $this->_Notice = $Notice;
    } 

    public function getNotice(){
        return $this->_Notice;
    }

    public function setImage($Image){
            $this->_Image = $Image;
    }

    public function getImage(){
        return $this->_Image;
    }

    public function setStatus($Status){
        $this->_Status = $Status;
    } 

    public function getStatus(){
        return $this->_Status;
    } 
}

class PostNotification{  
    private $_SubCatID;
    private $_Status;
    private $_Notice;
    private $_SubscriberID;

    public function setSubCatID($SubCatID){
            $this->_SubCatID = $SubCatID;
    }

    public function getSubCatID(){
        return $this->_SubCatID;
    }

    public function setStatus($Status){
            $this->_Status = $Status;
    }

    public function getStatus(){
        return $this->_Status;
    }

    public function setNotice($Notice){
            $this->_Notice = $Notice;
    }

    public function getNotice(){
        return $this->_Notice;
    }

    public function setSubscriberID($SubscriberID){
            $this->_SubscriberID = $SubscriberID;
    }

    public function getSubscriberID(){
        return $this->_SubscriberID;
    }
}

class File{
    
    private $_ID;
    private $_CategoryID;
    private $_PublisherID;
    private $_PublisherName;
    private $_Image;

    public function setID($ID){
            $this->_ID = $ID;
    }

    public function getID(){
        return $this->_ID;
    }

    public function setCategoryID($CategoryID){
            $this->_CategoryID = $CategoryID;
    }

    public function getCategoryID(){
        return $this->_CategoryID;
    }

    public function setPublisherID($PublisherID){
            $this->_PublisherID = $PublisherID;
    }

    public function getPublisherID(){
        return $this->_PublisherID;
    }
    public function setPublisherName($PublisherName){
            $this->_PublisherName = $PublisherName;
    }

    public function getPublisherName(){
        return $this->_PublisherName;
    }

    public function setImage($Image){
            $this->_Image = $Image;
    }

    public function getImage(){
        return $this->_Image;
    }

}

class ImageFile {
    private $_ID;
    private $_Name;
    private $_Image;

    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }

    public function setName ( $Name ) {
        $this->_Name = $Name;
    }

    public function getName () {
        return $this->_Name;
    }
    
    public function setImage( $Image ) {
        $this->_Image = $Image;
    }

    public function getImage() {
        return $this->_Image;
    }  
}

class Publisher {
    private $_ID;
    private $_Category;
    private $_Institution;
    private $_Username;
    private $_Password;

    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }
    
    public function setCategory( $Name ) {
        $this->_Category = $Category;
    }

    public function getCategory() {
        return $this->_Category;
    }  
    public function setInstitution ( $Institution) {
        $this->_Institution = $Institution;
    }

    public function getInstitution () {
        return $this->_Institution;
    }
    
    public function setUsername( $Name ) {
        $this->_Username = $Name;
    }

    public function getUsername() {
        return $this->_Username;
    } 
    public function setPassword( $Password ) {
        $this->_Password = $Password;
    }

    public function getPassword() {
        return $this->_Password;
    } 
}

class NewPublisher {
    private $_InstituteID;
    private $_CategoryID;
    private $_PublisherID;

    public function setInstituteID ( $InstituteID ) {
        $this->_InstituteID = $InstituteID;
    }

    public function getInstituteID () {
        return $this->_InstituteID;
    }
    
    public function setCategoryID( $CategoryID ) {
        $this->_CategoryID = $CategoryID;
    }

    public function getCategoryID() {
        return $this->_CategoryID;
    }  
    public function setPublisherID ( $PublisherID ) {
        $this->_PublisherID = $PublisherID;
    }

    public function getPublisherID () {
        return $this->_PublisherID;
    }
    
}
class AddSubscriber {
    private $_InstituteID;
    private $_CategoryID;
    private $_SubscriberID;

    public function setInstituteID ( $InstituteID ) {
        $this->_InstituteID = $InstituteID;
    }

    public function getInstituteID () {
        return $this->_InstituteID;
    }
    
    public function setCategoryID( $CategoryID ) {
        $this->_CategoryID = $CategoryID;
    }

    public function getCategoryID() {
        return $this->_CategoryID;
    }  
    public function setSubscriberID ( $SubscriberID ) {
        $this->_SubscriberID = $SubscriberID;
    }

    public function getSubscriberID () {
        return $this->_SubscriberID;
    }
    
}

class Request{
    private $_ReqID;
    private $_InstituteID;
    private $_SubscriberID;
    private $_CatID;
    private $_Status;

    public function setRequestID($ReqID){
        $this->_ReqID = $ReqID;
    }

    public function getRequestID () {
        return $this->_ReqID;
    }

    public function setInstituteID($InstituteID ) {
        $this->_InstituteID = $InstituteID;
    }

    public function getInstituteID() {
        return $this->_InstituteID;
    }

    public function setSubscriberID($SubscriberID){
        $this->_SubscriberID = $SubscriberID;
    }

    public function getSubscriberID() {
        return $this->_SubscriberID;
    }

    public function setCatID($CatID){
        $this->_CatID = $CatID;
    }

    public function getCatID () {
        return $this->_CatID;
    }

    public function setStatus($Status){
        $this->_Status = $Status;
    }

    public function getStatus () {
        return $this->_Status;
    }
}

class RequestPublisher{
    private $_ReqID;
    private $_InstituteID;
    private $_OrganizerID;
    private $_PublisherID;
    private $_CatID;
    private $_Status;

    public function setRequestID($ReqID){
        $this->_ReqID = $ReqID;
    }

    public function getRequestID () {
        return $this->_ReqID;
    }

    public function setInstituteID($InstituteID ) {
        $this->_InstituteID = $InstituteID;
    }

    public function getInstituteID() {
        return $this->_InstituteID;
    }

    public function setOrganizerID($OrganizerID ) {
        $this->_OrganizerID = $OrganizerID;
    }

    public function getOrganizerID() {
        return $this->_OrganizerID;
    }

    public function setPublisherID($PublisherID){
        $this->_PublisherID = $PublisherID;
    }

    public function getPublisherID() {
        return $this->_PublisherID;
    }

    public function setCatID($CatID){
        $this->_CatID = $CatID;
    }

    public function getCatID () {
        return $this->_CatID;
    }

    public function setStatus($Status){
        $this->_Status = $Status;
    }

    public function getStatus () {
        return $this->_Status;
    }
}


class Role{

    private $_ID;
    private $_Name;
    private $_Permissions;


    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }


    public function setName( $Name ) {
        $this->_Name = $Name;
    }

    public function getName() {
        return $this->_Name;
    }

    public function setPermissions( $Permissions ) {
        $this->_Permissions = $Permissions;
    }

    public function getPermissions() {
        return $this->_Permissions;
    }

}

class Permission{

    private $_ID;
    private $_Name;
    private $_Category;
    private $_IsChecked;

    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }


    public function setName( $Name ) {
        $this->_Name = $Name;
    }

    public function getName() {
        return $this->_Name;
    }

    public function setCategory( $Category ) {
        $this->_Category = $Category;
    }

    public function getCategory() {
        return $this->_Category;
    }

    public function setIsChecked( $IsChecked ) {
        $this->_IsChecked = $IsChecked;
    }

    public function getIsChecked() {
        return $this->_IsChecked;
    }


}

class Tree 
{
   private $_ID;
   private $_Name;
   private $_ParentID;

    public function setID( $ID ) {
        $this->_ID = $ID;
    }

    public function getID() {
        return $this->_ID;
    }

    public function setName( $Name ) {
        $this->_Name = $Name;
    }

    public function getName() {
        return $this->_Name;
    }

    public function setParentID( $ParentID ) {
        $this->_ParentID = $ParentID;
    }

    public function getParentID() {
        return $this->_ParentID;
    }
}

class RolePermission{

    private $_Role;
    private $_PermissionList = array();

    public function setRole ( $Role ) {
        $this->_Role = $Role;
    }

    public function getRole () {
        return $this->_Role;
    }


    public function setPermissionList( $PermissionList ) {
        if(is_array($PermissionList)){
            $this->_PermissionList = $PermissionList;
        }
        else{
            throw new Exception("Error!! not an array!!!");
        }
            
    }

    public function getPermissionList() {
        return $this->_PermissionList;
    }

    public function addNewPermission($Permission){

        $this->_PermissionList[]=$Permission;

    }

}

class Session{
    public static function init(){
        ob_start();
        if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
      if (isset($_SESSION[$key])) {
       return $_SESSION[$key];
      } else {
       return false;
      }
    }

    public static function checkSession(){
        self::init();
        if (self::get("login") == false) {
            self::destroy();
            header("Location:view.user.php");
        }
    }

    public static function destroy(){
        session_destroy();
        header("Location:view.user.php");
    }  

    public static function checkLogin(){
      self::init();
      if (self::get("login")== true) {
       header("Location:index.php");
      }
     }    
}

class PermissionUtil{

    public static $PUBLISHER_C='PUBLISHER_C';
    public static $PUBLISHER_R='PUBLISHER_R';
    public static $PUBLISHER_U='PUBLISHER_U';
    public static $PUBLISHER_D='PUBLISHER_D';

    public static $SUBSCRIBER_C='SUBSCRIBER_C';
    public static $SUBSCRIBER_R='SUBSCRIBER_R';
    public static $SUBSCRIBER_U='SUBSCRIBER_U';
    public static $SUBSCRIBER_D='SUBSCRIBER_D';

    public static $NOTICE_C='NOTICE_C';
    public static $NOTICE_R='NOTICE_R';
    public static $NOTICE_U='NOTICE_U';
    public static $NOTICE_D='NOTICE_D';

    public static $CATEGORY_C='CATEGORY_C';
    public static $CATEGORY_R='CATEGORY_R';
    public static $CATEGORY_U='CATEGORY_U';
    public static $CATEGORY_D='CATEGORY_D';

    public static $CONTENT_C='CONTENT_C';
    public static $CONTENT_R='CONTENT_R';
    public static $CONTENT_U='CONTENT_U';
    public static $CONTENT_D='CONTENT_D';

    public static $ROLE_C='ROLE_C';
    public static $ROLE_R='ROLE_R';
    public static $ROLE_U='ROLE_U';
    public static $ROLE_D='ROLE_D';

}

class PageUtil{

    public static $CLUB='club.php';
    public static $COURSE='course.php';

    public static $DISCIPLINE='discipline.php';
    public static $DISCUSSION='discussion.php';

    public static $ERROR='error.php';

    public static $FILE='file.php';
    public static $HOME='home.php';

    public static $QUESTION='question.php';

    public static $LOGIN='login.php';

    public static $PROJECT='project.php';
    public static $POSITION='position.php';
    public static $PERMISSION='permission.php';

    public static $ROLE='role.php';
    public static $RESOURCE='resource.php';


    public static $SCHOOL='school.php';
    public static $SESSION='session.php'; 
    public static $SURVEY='survey.php';
    
    public static $TERM='term.php';

    public static $USER='user.php';

    public static $YEAR='year.php';
    
    public static $VIDEO='video.php';
   
}

class RouteUtil{

    private static $s_Routes; //The single instance
    private static $s_instance; //The single instance


    private function RouteUtil(){
        
         self::$s_Routes = array();

        //add new page and routing address here always
         self::$s_Routes[PageUtil::$DISCIPLINE]       =   "/modules/dash/view.discipline.php";

         self::$s_Routes[PageUtil::$HOME]             =   "/modules/dash/view.home.php";

         self::$s_Routes[PageUtil::$LOGIN]            =   "/modules/dash/view.login.php";

         self::$s_Routes[PageUtil::$PERMISSION]       =   "/modules/dash/view.permission.php";
         self::$s_Routes[PageUtil::$POSITION]         =   "/modules/dash/view.position.php";

         self::$s_Routes[PageUtil::$ROLE]             =   "/modules/dash/view.role.php";

         self::$s_Routes[PageUtil::$SCHOOL]           =   "/modules/dash/view.school.php";

         self::$s_Routes[PageUtil::$TERM]             =   "/modules/regs/view.term.php";

         self::$s_Routes[PageUtil::$USER]             =   "/modules/dash/view.user.php";

        //the page not found will redirect to error page
         self::$s_Routes[PageUtil::$ERROR]            =   "/modules/dash/view.error.php";

    }

    public static function getInstance() {
        if(!self::$s_instance) { // If no instance then make one
            self::$s_instance = new self();
        }
        return self::$s_instance;
    }

    public static function get($Page){

        $Page = strtolower(trim($Page)); 

        if(array_key_exists($Page, self::$s_Routes)){
        
            return self::$s_Routes[$Page];
        }
        else{
        
            return self::$s_Routes[PageUtil::$ERROR]; 
        }
    }

}

RouteUtil::getInstance();

?>