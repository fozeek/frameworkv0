<?php

class UserControler extends Controler {
	public function IndexAction($params) {
		return $this->redirect("user/list");
	}

	public function ShowAction($params) {
		$user = App::getClass("user", $params[3]);
		return $this->render(array('user' => $user));
	}

	public function AddAction($params) {
		return $this->render(array('user' => null));
	}

	public function DeleteAction($params) {
		$user = App::getClass("user", $params[3]);
		return $this->render(array('user' => $user));
	}

	public function UpdateAction($params) {
		$method = $this->getRequest();
		if($method->isMethod("post")) {
			return $this->redirect("/user/show/".$params[3]);
		}
		else {
			$user = App::getClass("user", $params[3]);
			return $this->render(array('user' => $user));
		}
	}

	public function ListAction($params) {
		$users = App::getClassArray("user");
		return $this->render(array('users' => $users));
	}
}

?>