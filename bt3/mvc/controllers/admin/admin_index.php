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
		require './mvc/views/admin/show.php';
		break;
	}

	case 'edit':{
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$itemID = $db->getSingleData($id);
			$client_path = $_FILES['itemthumb']['tmp_name'];
			$server_path = './upload/' . $_FILES['itemthumb']['name'];
			if (isset($_POST['update_item'])){
				if (isset($_FILES['itemthumb'])){
					if ($_FILES['itemthumb']['error'] > 0){
						echo 'File upload error' . '<br/>';
					}
					else{
						if (move_uploaded_file($client_path, $server_path)){
							echo 'File uploaded'. '<br/>';
						}
						else {
							echo 'File upload error' . '<br/>';
						}
					}
				}

				$thumb = ($server_path != $dataID[0]['image']) ? $server_path : $dataID[0]['image'];
				$title = ($_POST['itemtitle'] != $dataID[0]['title']) ? $_POST['itemtitle'] : $dataID[0]['title'];
				$status = ($_POST['itemstatus'] != $dataID[0]['status']) ? $_POST['itemstatus'] : $dataID[0]['status'];
				$description = ($_POST['itemdescription'] != $dataID[0]['status']) ? $_POST['itemdescription'] : $dataID[0]['status'];
				$edit_success = ($db->updateData($id, $title, $description, $thumb, $status)) ? 1: 0;
			}
		}
	require './mvc/views/admin/edit.php';
	break;
	}
	case 'add':{
		if (isset($_POST['add_item'])){
			$client_path = $_FILES['itemthumb']['tmp_name'];
			$server_path = './upload/' . $_FILES['itemthumb']['name'];
			var_dump($client_path);
			var_dump($server_path);
			if (isset($_FILES['itemthumb'])){
				if ($_FILES['itemthumb']['error'] > 0){
					echo 'File upload error';
				}
				else {
					if (!move_uploaded_file($client_path, $server_path)){
						echo '<br/>' . 'File upload error '. "<br/>";
					}
				}
			}

			$thumb = $server_path;
			$title = $_POST['itemtitle'];
			$status = $_POST['itemstatus'];
			$description = $_POST['itemdescription'];
			$success = ($db->insertData($title, $description, $thumb, $status)) ? 1 : 0;
			echo 'some thing '. $success;
		}

		require './mvc/views/admin/add.php';
		break;
	}

	case 'delete':{
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$del_success = ($db->deleteData($id)) ? 1 : 0;
			if ($del_success){
				header('location: index.php?controller=admin&action=show');
			}
			else{
				echo 'Delete Failed';
			}
		}
		break;
	}

	case 'detail':{
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$dataID = $db->getSingleData($id);
		}
		require './mvc/views/admin/detail.php';
		break;
	}

	default:{
		echo 'Action must be add/ edit/ delete/ show/ detail';
	}

}
?>