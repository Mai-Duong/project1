<?php 
session_start();
require_once('./controller/trangchu.php');
$controller = new Controller();
$task = isset($_GET['task']) ? $_GET['task'] : 'index';
switch ($task) {
	case 'index':
		$controller->index();
		break;
	case 'user':
		$controller->user();
		break;
	case 'caidat':
		$controller->caidat();
		break;
	default:
		$controller->index();
		break;
}

 ?>