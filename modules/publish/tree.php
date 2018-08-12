<?php 
/*$db = new mysqli('localhost','root','','publish_subscription');
$query = "SELECT * FROM tbl_tree";
$result = mysqli_query($db, $query);
while ($row = mysqli_fetch_array($result)) {
	$sub_data["ID"] = $row["ID"];
	$sub_data["Name"]  = $row["Name"];
	$sub_data["text"]  = $row["Name"];
	$sub_data["ParentID"]  = $row["ParentID"];
    $data[] = $sub_data;
}

foreach ($data as $key => &$value) 
{
	$output[$value["ID"]] = &$value;
}

foreach ($data as $key => &$value)
{
	if ($value["ParentID"] && isset($output[$value["ParentID"]]))
	{
			$output[$value["ParentID"]]["nodes"][] = &$value;
	}	
}

foreach ($data as $key => &$value)
{
	if ($value["ParentID"] && isset($output[$value["ParentID"]]))
	{
			unset($data[$key]);
	}	
}
//$js_array = (array)json_encode($data);
//print_r($js_array);
//echo 'var data = '.$js_array.';';
echo json_encode($data);
//echo '<pre>';
//print_r($data);
//echo '</pre>';*/
?>  
<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "publish_subscription");
$query   = "SELECT * FROM tbl_tree";
$result  = mysqli_query($connect, $query);
//$output = array();
while($row = mysqli_fetch_array($result))
{
 $sub_data["ID"] = $row["ID"];
 $sub_data["Name"] = $row["Name"];
 $sub_data["text"] = $row["Name"];
 $sub_data["ParentID"] = $row["ParentID"];
 $data[] = $sub_data;
}
foreach($data as $key => &$value)
{
 $output[$value["ID"]] = &$value;
}

foreach($data as $key => &$value)
{
 if($value["ParentID"] && isset($output[$value["ParentID"]]))
 {
  $output[$value["ParentID"]]["nodes"][] = &$value;
 }
}

foreach($data as $key => &$value)
{
 if($value["ParentID"] && isset($output[$value["ParentID"]]))
 {
  unset($data[$key]);
 }
}
echo json_encode($data);
/*echo '<pre>';
print_r($data);
echo '</pre>';*/

?> 