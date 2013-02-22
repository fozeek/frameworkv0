<?php

class ParamControler extends Controler {
	public function IndexAction($params) {
		//$return = App::getClass("user", 2);
		return $this->render(array('user' => null));
	}
}

?>