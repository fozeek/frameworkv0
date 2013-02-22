<?php

class TagControler extends Controler {
	public function IndexAction($params) {
		return $this->redirect(Kernel::getURL("tag/list"));
	}

	public function ShowAction($params) {
		if(!empty($params[4]))
			$lang = $params[4];
		else
			$lang = $params[0];
		$tag = App::getClass("tag", $params[3]);
		return $this->render(array('tag' => $tag, "lang" => $lang));
	}

	public function AddAction($params) {
		$method = $this->getRequest();
		if($method->isMethod("post")){
			$data = $method->getData();
			$name = array("fr"=>$data["namefr"], "en"=>$data["nameen"]);
			$desc = array("fr"=>$data["descriptionfr"], "en"=>$data["descriptionen"]);
			$attr["name"] = $name;
			$attr["description"] = $desc;
			if($tag = App::getClass("tag")->hydrate($attr)->save())
				return $this->redirect(Kernel::getURL("tag/show/".$tag->get("id")));
			else
				return $this->render(array("error" => "Vous n'avez pas bien rempli le formulaire"));
		}
		else{		
			return $this->render(null);
		}
	}

	public function DeleteAction($params) {
		$method = $this->getRequest();
		if($method->isMethod("post")){
			$data = $method->getData();
			$id = $data["id"];
			if($tag = App::getClass("tag", $id)->set("deleted", true)) 
				return $this->redirect(Kernel::getUrl("tag/list"));
			else
				return $this->render(array('tag' => $tag));
		}
		return $this->redirect(Kernel::getURL("tag/list"));
	}

	public function UpdateAction($params) {
		$method = $this->getRequest();
		if($method->isMethod("post")) {
			return $this->redirect(Kernel::getURL("/tag/show/".$params[3]));
		}
		else {
			$tag = App::getClass("tag", $params[3]);
			return $this->render(array('tag' => $tag));
		}
	}

	public function ListAction($params) {
		if(!empty($params[3]))
			$lang = $params[3];
		else
			$lang = $params[0];
		$tags = App::getClassArray("tag", array("where"=>"deleted=0"));
		return $this->render(array('tags' => $tags, "lang" => $lang));
	}
}

?>