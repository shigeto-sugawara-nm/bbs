<?php
require_once './conf/config.php';
require_once './Dispatcher.php';

try {
	$dispatcher = new Dispatcher();
	$dispatcher->dispatch();
} catch (Exception $e) {
	$msg = $e->getMessage();
	// TODO:error
}
?>