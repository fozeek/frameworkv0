<?php header('Content-Type: text/html; charset=UTF-8');


	/* ERROR REPORTING */
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	if(!empty($_POST)) {

		$origin = file_get_contents("fr.json");
		$origin = json_decode($origin);

		if(!empty($origin))
			$origin[] = array($_POST["text"] => $_POST["tradfr"]);
		else
			$origin = array(array($_POST["text"] => $_POST["tradfr"]));

		file_put_contents("fr.json", json_encode($origin));


		$origin = file_get_contents("en.json");
		$origin = json_decode($origin);

		if(!empty($origin))
			$origin[] = array($_POST["text"] => $_POST["traden"]);
		else
			$origin = array(array($_POST["text"] => $_POST["traden"]));

		file_put_contents("en.json", json_encode($origin));

	} ?>
<form method="post" action="">
	TEXT : <input type="text" name="text" /><br />
	FR : <input type="text" name="tradfr" /><br />
	EN : <input type="text" name="traden" /><br />
	<input type="submit"/>
</form>

