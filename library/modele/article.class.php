<?php

/*
	Class User
	Description : 
		-
		-
*/

class Article extends OrmStdAbstract {

	

	public function view() {
		$this->set(array("views" => $this->get("views")+1));
	}
	

}



?>