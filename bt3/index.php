<?php
session_start();

require_once './mvc/models/item.php';

$db = new Item;
$controller = null;

if (isset($_GET['controller'])){
	$controller = $_GET['controller'];
}
else {
	$controller = '';
}

switch ($controller) {
	case 'admin':{
		require_once './mvc/controllers/admin/admin_index.php';
		break;
	}

	case 'client':{
		require_once './mvc/controllers/client/client_index.php';
		break;
	}
}
?>