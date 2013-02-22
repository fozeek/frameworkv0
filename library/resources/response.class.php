<?php




class Response {

	static public $STATUS_REDIRECT = 1;
	static public $STATUS_HTTP = 2;
	static public $STATUS_404 = 3;
	static public $STATUS_XML = 4;

	private $status;
	private $route;
	private $vars;

	public function __construct($status, $route = null, $vars = null) {
		if(!empty($vars)) {
			if(is_array($vars))
				$this->vars = $vars;
			else
				$this->vars = array("return" => $vars);
		}
		$this->status = $status;
		$this->route = $route;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getRoute() {
		return $this->route;
	}

	public function getVars() {
		return $this->vars;
	}

	public function hasRoute() {
		if($this->route==null)
			return false;
		else
			return true;
	}

	public function hasVars() {
		if($this->vars==null)
			return false;
		else
			return true;
	}



}


?>