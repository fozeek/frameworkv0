<?php

class NodeControler extends Controler {
	public function IndexAction($params) {
		return $this->redirect("node/list");
	}

	public function ShowAction($params) {
		$node = App::getClass("node", $params[3]);
		return $this->render(array('node' => $node));
	}

	public function AddAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$name = array("fr" => $data["namefr"], "en" => $data["nameen"]);
			$desc = array("fr" => $data["descriptionfr"], "en" => $data["descriptionen"]);
			$attr["name"] = $name;
			$attr["description"] = $desc;
			if($node = App::getClass("node")->hydrate($attr)->save())
				return $this->redirect("node/show/".$node->get("id"));
			else
				return $this->render(array("error" => "Vous n'avez pas bien rempli le formulaire"));
		}
		else {
			return $this->render(null);
		}
	}

	public function DeleteAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")){
			$data = $form->getData();
			$id = $data["id"];
			$node = App::getClass("node", $id)->set("deleted", 1);
		}
		return $this->redirect("node/list");
	}

	public function UpdateAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$id = $data["id"];
			$name = array("fr" => $data["namefr"], "en" => $data["nameen"]);
			$desc = array("fr" => $data["descriptionfr"], "en" => $data["descriptionen"]);
			$attr["name"] = $name;
			$attr["description"] = $desc;
			if($node = App::getClass("node", $id)->set($attr))
				return $this->redirect("node/show/".$node->get("id"));
			else
				return $this->render(array("error" => "Vous n'avez pas bien rempli le formulaire"));
		}
		else {
			$node = App::getClass("node", $params[3]);
			return $this->render(array('node' => $node));
		}
	}

	public function ListAction($params) {
		$nodes = App::getClassArray("node", array("where"=>"deleted=0"));
		
		return $this->render(array('nodes' => $nodes));
	}
}

?>