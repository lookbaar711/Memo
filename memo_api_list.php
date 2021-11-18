<?php
	date_default_timezone_set('Asia/Bangkok');
	define('BASE_PATH', dirname(__FILE__) . '/');

	if($_SERVER['HTTP_HOST'] == 'localhost'){
		require_once('../../../include/config/globalvariable.inc.php'); 
		require_once('../../../include/config/connectdb.inc.php'); 
		require_once('prettyjson.php');
		require_once('MemoApp.php');
    }
    else{
        include_once('../../../include/config/globalvariable.inc.php'); 
		include_once('../../../include/config/connectdb.inc.php'); 
		include_once('prettyjson.php');
		include_once('MemoApp.php');
    }

	$output = empty($_GET['output']) ? 'json' : $_GET['output'];
	$img_size = empty($_POST['img_size']) ? 'full' : $_POST['img_size'];
	$posts_per_page =  empty($_POST['per_page']) ? 10 : $_POST['per_page'];
	$page =  empty($_POST['page']) ? 1 : intval($_POST['page']);

	$service = new MemoApp();
  	$result = $service->handler($_POST , $_FILES);
  	
  	// Output
	if($output == 'json') {
		header('Content-type: text/json');
		header('Content-type: application/json');
		
		$result_json = json_encode($result);
	} else {
		// Pretty print 
		$result_json = nl2br(json_format(json_encode($result)));
	}

  	print_r($result_json);
  	
?>