<?php 
include_once '/../../common/class.common.php';
include_once 'blade/view.user.blade.php';
include_once 'blade/view.subcategory.blade.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
    .item {
      cursor: pointer;
    }
    .bold {
      font-weight: bold;
    }
    ul {
      padding-left: 1em;
      line-height: 1.5em;
      list-style-type: dot;
    }
  </style>
  <script type="text/javascript">

  </script>
</head>
<body>
  <div class="container">
  <ul id="parent-list">
    
  </ul>
  <script type="text/javascript">
    <?php 
    $Result = $_SubcategoryBAO->getSubcategory();
    $Zerolevel = array();
    $allData = array();
    $selfData = array();
    $hashData = array();
    $x = 0;
    if($Result->getIsSuccess()){

      $SubcategoryList = $Result->getResultObject();
      for ($i = 0; $i<sizeof($SubcategoryList); $i++){
        $Subcategory = $SubcategoryList[$i];
          //echo $Subcategory->getName();
          //echo 'console.log("'.$Subcategory->getName().'");';
          //echo 'console.log("'.$Subcategory->getParentID().'");';
          
          if($Subcategory->getParentID() == "0")
          {
            //echo 'console.log("inside");';
            $Zerolevel[$Subcategory->getName()] = $Subcategory->getCatID();
            $hashData[$Subcategory->getCatID()] = $x;
            $x += 1;
          }
          else
          {
            //echo 'colsole.log("Outside");';
            $allData[$Subcategory->getName()]  = $Subcategory->getParentID();
            $selfData[$Subcategory->getName()] = $Subcategory->getCatID();
            $hashData[$Subcategory->getCatID()] = $x;
            $x += 1;
          }
        }
       }
      $js_array = json_encode($Zerolevel);
      echo 'var zeroLevel = '.$js_array.';'; 
      $js_array = json_encode($allData);
      echo 'var allData = '.$js_array.';'; 
      $js_array = json_encode($selfData);
      echo 'var selfData = '.$js_array.';';
      $js_array = json_encode($hashData);
      echo 'var hashData = '.$js_array.';';
       ?>
       var doneYet = [];
       var node = document.createElement('div');
       node.className = 'zero';
       var len = Object.keys(zeroLevel).length;
       console.log(len);
      for(var key in zeroLevel)
      {
        //document.getElementById('xxx').innerHtml += key + '<br>';
        var txt = document.createElement('LI');
        txt.className = "one";
        txt.innerHTML = key;
        txt.id = hashData[zeroLevel[key].toString()];
        node.appendChild(txt);
      }
      document.getElementById('parent-list').appendChild(node);

      document.addEventListener('mouseover',function(e)
      {
        //console.log("indise");
        //console.log(e.target.className);
        var cls = e.target.className;
        if(e.target.className.split(' ').indexOf('one') > -1)
        {
          var getId = e.target.id;
          var clked = document.getElementById(getId);
          //console.log(getId);
          if(getId.toString() in doneYet)
          {
              var slct = '.two' + getId ;
             // console.log(slct);
              var el = document.querySelector(slct.toString());
              delete doneYet[getId.toString()];
              el.parentNode.removeChild(el);
          }
          else
          {
            //console.log("2nd");
              addLevel(clked,'two'+getId,getId);
          }
        }
        else if(cls[0] ==='t' && cls[1] ==='w' && cls[2]==='o')
        {
          //console.log("inside");
          var iid = e.target.id;
          var clked = document.getElementById(iid);
          if(iid.toString() in doneYet)
          {
            delete doneYet[iid.toString()];
            var slct = '.thr'+ iid ;
            console.log(slct);
            var el = document.querySelector(slct.toString());
            el.parentNode.removeChild(el);
          }
          else
          {
            addLevel(clked,'thr'+iid,iid);
          }
        }
        else if(cls[0] ==='t' && cls[1] ==='h' && cls[2]==='r')
        {
           var iid = e.target.id;
           var clked = document.getElementById(iid);
          if(iid.toString() in doneYet)
          {
            delete doneYet[iid.toString()];
            var slct = '.four'+ iid ;
              var el = document.querySelector(slct.toString());
            el.parentNode.removeChild(el);
          }
          else
          {
            addLevel(clked,'four'+iid,iid);
          }
        }
       else if(cls[0] ==='f' && cls[1] ==='o' && cls[2]==='u' && cls[3]==='r')
        {
           var iid = e.target.id;
           var clked = document.getElementById(iid);
          if(iid.toString() in doneYet)
          {
            delete doneYet[iid.toString()];
            var slct = '.five'+ iid ;
              var el = document.querySelector(slct.toString());
            el.parentNode.removeChild(el);
          }
          else
          {
            addLevel(clked,'five'+iid,iid);
          }
        }
        
      }, false);

      function addLevel(toAdd,level,chk)
      {
        doneYet[chk.toString()] = 1;
        var nw = document.createElement('div');
        nw.className = level;
       // console.log(level);
       // nw.style.color = 'red';
        var alter = 0;
        for(var keys in allData)
        {
          if(hashData[allData[keys]] == chk)
          {
            alter = 1;
            var crt = document.createElement('UL');
            crt.className = level;
            crt.innerHTML = '<a href="home.php">' + keys + '</a>';
            crt.id = hashData[selfData[keys].toString()];
            nw.appendChild(crt);
          }
        }
        if(alter ===1 ) 
          toAdd.appendChild(nw);
        else 
        {
          delete doneYet[chk.toString()];
        }
      }

      </script>
</div>
</body>
</html>

