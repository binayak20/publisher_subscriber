<?php 
include_once 'blade/view.image.blade.php';
include_once '/../../common/class.common.php';
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Add Image</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
    <center>
        <div id="form">
             <form action="" method="post" enctype="multipart/form-data">
               <table>
                <tr>
                     <td>Select Image</td>
                     <td><input type="file" name="image"/></td>
                </tr>

                <tr>
                     <td>Document Name</td>
                     <td><input type="text" name="doc_name" /></td>
                </tr>

                <tr>
                     <td></td>
                     <td><input type="submit" name="submit" value="Upload"/></td>
                </tr>

               </table>
            </form>
              <br />
            <table  width="100%" border="1" cellpadding="15" align="center">
                <?php
                   $Result = $_ImageBAO->getAllImage();
                     if ($Result->getIsSuccess()){
                       $ImageList = $Result->getResultObject();
                   ?>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Image</td>
                    </tr>
                    <?php  
                    for($i = 0; $i < sizeof($ImageList); $i++) {
                        $ImageFile = $ImageList[$i];
                    ?>
                    <tr>
                        <td><?php echo $ImageFile->getID(); ?></td>
                        <td><?php echo $ImageFile->getName(); ?></td>
                        <td><img src="<?php echo $ImageFile->getImage(); ?>" height="100px" 
                               width="200px"/><a href='view.image.php?dow=<?php echo $ImageFile->getImage(); ?>'>Download</a></td>
                    </tr>   

                <?php 
                  }
                    }
                        else{
                        echo $Result->getResultObject(); //giving failure message
                       } 
                 ?>
            </table>
         </div>
    </center>
     </body>
</html>