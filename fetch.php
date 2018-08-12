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
<?php
$connect = mysqli_connect("localhost", "root", "", "publish_subscription");
$query   = "SELECT * FROM tbl_tree";
$result  = mysqli_query($connect, $query) or die("database error:". mysqli_error($connect));
//iterate on results row and create new index array of data
while( $row = mysqli_fetch_assoc($result) ) {
    /* $sub_data["ID"] = $row["ID"];
	 $sub_data["Name"] = $row["Name"];
	 $sub_data["text"] = $row["Name"];
	 $sub_data["ParentID"] = $row["ParentID"];*/
$data[] = $row;
}
$itemsByReference = array();
// Build array of item references:
foreach($data as $key => &$item) {
$itemsByReference[$item['ID']] = &$item;
// Children array:
$itemsByReference[$item['ID']]['children'] = array();
// Empty data class (so that json_encode adds "data: {}" )
$itemsByReference[$item['ID']]['data'] = new StdClass();
}
// Set items as children of the relevant parent item.
foreach($data as $key => &$item)
if($item['ParentID'] && isset($itemsByReference[$item['ParentID']]))
$itemsByReference [$item['ParentID']]['children'][] = &$item;
// Remove items that were added to parents elsewhere:
foreach($data as $key => &$item) {
if($item['ParentID'] && isset($itemsByReference[$item['ParentID']]))
unset($data[$key]);
}
// Encode:
echo json_encode($data);
?>