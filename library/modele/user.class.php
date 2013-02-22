<?php

/*
	Class User
	Description : 
		-
		-
*/

class User extends OrmStdAbstract {
	public function access($code) {
		$access = $this->get("access");
		foreach ($access as $key => $value) {
			if($value->get("code")==$code) {
				return true;
			}
		}
		return false;
	}
}



?>