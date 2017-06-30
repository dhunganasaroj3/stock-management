<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editBrandName'];
  	$brandStatus = $_POST['editBrandStatus']; 
  	$brandId = $_POST['brandId'];

  	$check_sql = "SELECT * FROM brands WHERE brand_name = '$brandName' ";
	$result = $connect->query($check_sql);
	if (!$result) {
		echo ('A database error occurred in processing your '.'submission.\nIf this error persists, please '.'contact binod1365@gmail.com.');
	}
		if ($result->num_rows === 0){
  			$sql = "UPDATE brands SET brand_name = '$brandName', brand_active = '$brandStatus' WHERE brand_id = '$brandId'";
			if($connect->query($sql) === TRUE) {
			 	$valid['success'] = TRUE;
				$valid['messages'] = "Successfully Updated";	
			} else {
			 	$valid['success'] = FALSE;
			 	$valid['messages'] = "Error while adding the members";
			}
		}
		if ($result->num_rows == 1){
			$valid["success"] = FALSE;
			$valid["messages"] ="Data already in database .Please check into your database OR Choose other!!";
		
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
