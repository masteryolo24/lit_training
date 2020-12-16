<?php
if (isset($_GET['action'])){
	$action = $_GET['action'];
}
else {
	$action = '';	
}

$success = 0;
$edit_success = 0;
$del_success = 0;

switch($action){
	case 'show':{
		$data = $db->getData();
		$total_rows = $db->num_rows();

		$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 5;
		$current_page = !empty($_GET['page']) ? $_GET['page']:1;
		$offset = ($current_page - 1) * $item_per_page;
		$total_pages = ceil($total_rows / $item_per_page);
		$page_item = $db->getPageData($item_per_page, $offset);
		require './mvc/views/client/show.php';
		break;
	}


	case 'detail':{
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$dataID = $db->getSingleData($id);
		}
		require './mvc/views/client/detail.php';
		break;
	}

	default:{
		echo 'Action must be add/ edit/ delete/ show/ detail';
	}

}
?>