<?php
	switch ($_SERVER['SCRIPT_NAME']) {
		case '/digital wallet/home.php':
			$CURRENT_PAGE = "Home";
			$PAGE_TITLE = "Home Page";
			break;
		case '/digital wallet/history.php':
			$CURRENT_PAGE = "Transition";
			$PAGE_TITLE = "Transition History Page";
			break;
		default:
			$CURRENT_PAGE = "Home";
			$PAGE_TITLE = "Home Page";
			break;
	}
?>