<?php 


Class Request {

	public function isMethod($type) {
		$type = strtolower($type);
		if(!empty($_POST) && $type=="post")
			return true;
		elseif(count($_GET)>1 && $type=="get") // >0 car urlrewriting
			return true;
		else
			return false;
	}

	public function getData() {
		if(!$data = Kernel::get("session")->getSavedRequest())
			$data = $_REQUEST;
		unset($data["url"]);
		unset($data["PHPSESSID"]);
		return $data;
	}

}



?>