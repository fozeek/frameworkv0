<?php

class CategoryControler extends Controler {
	public function IndexAction($params) {
		return $this->redirect("category/list");
	}

	public function ShowAction($params) {
		$category = App::getClass("category", $params[3]);
		if(!empty($params[4]))
			$lang = $params[4];
		else
			$lang = $params[0];
		return $this->render(array('category' => $category, "lang" => $lang));
	}

	public function AddAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$name = array("fr" => $data["name-fr"], "en" => $data["name-en"]);
			$desc = array("fr" => $data["description-fr"], "en" => $data["description-en"]);
			$attr["name"] = $name;
			$attr["description"] = $desc;
			$attr["image"] = $data["image"];
			$attr["deleted"] = 0;
			if($categorie = App::getClass("category")->hydrate($attr)->save())
				return $this->redirect(Kernel::getURL("category/show/".$categorie->get("id")));
			else
				return $this->render(array("error" => "Vous n'avez pas bien rempli le formulaire"));
		}
		else {
			return $this->render(null);
		}
	}

	public function DeleteAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$id = $data["id"];
			$category = App::getClass("category", $id);
	
			if($category->set(array("deleted" => true)))
				return $this->redirect(Kernel::getUrl("category/list"));
			else
				return $this->redirect(Kernel::getUrl("category/delete/".$id));
		}
		else {
			$category = App::getClass("category", $params[3]);
			return $this->render(array('category' => $category));
		}
	}

	public function UpdateAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$id = $data["id"];
			$category = App::getClass("category", $id);
			$attr["name"] = array("fr" => $data["name-fr"], "en" => $data["name-en"]);
			$attr["description"] = array("fr" => $data["description-fr"], "en" => $data["description-en"]);
			if($category->set($attr))
				return $this->redirect(Kernel::getUrl("category/show/".$category->get("id")));
			else
				return $this->render(array('category' => $category));
		}
		else {
			$category = App::getClass("category", $params[3]);
			return $this->render(array('category' => $category));
		}
	}

	public function ListAction($params) {
		if(!empty($params[3]))
			$lang = $params[3];
		else
			$lang = $params[0];
		$categories = App::getClassArray("category");//, array("where" => "deleted = 0"));
		return $this->render(array('categories' => $categories, 'lang' => $lang));
	}
}

?>