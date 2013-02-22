<?php



class Session {

	private $tmp_user_register;
	private $user;
	private $session;

	public function __construct() {
	    $this->session = $_SESSION;
	    
	    
	    if(!empty($this->session["user"])) {
		if($user = App::getClass("user", $this->session["user"]["id"])) {
		    if($user->get("password") == $this->session["user"]["pwd"])
			$this->user = $user;
		    else
			$this->user = false;
		}
		    else
			$this->user = false;
	    }
	    else
		$this->user = false;
	}

	public function getUser() {
		return $this->user;
	}

	public function connect($user) {
		$_SESSION["user"] = array();
		$_SESSION["user"]["id"] = $user->get("id");
		$_SESSION["user"]["pwd"] = "".$user->get("password");
		$this->user = $user;
		
		return true;
	}

	public function disconnect() {
		if(!empty($this->user)) {	
			unset($_SESSION["user"]);
			unset($_SESSION["first_connection"]);
			$this->user = false;
			$this->session = "";
			return true;
		}
		else
			return false;
	}
	public function set($key, $value){
	    $_SESSION[$key] = $value;
	}
	public function get($key){
	    return $_SESSION[$key];
	}
	public function containsKey($key){
	    return (isset($_SESSION[$key]));
	}

	public function saveRequest() {
		if(!empty($_REQUEST))
			$_SESSION["request"] = $_REQUEST;
	}

	public function getSavedRequest() {
		if(!empty($_SESSION["request"]))
			return $_SESSION["request"];
		else false;
	}
}




?>