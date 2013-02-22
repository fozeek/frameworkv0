<?php

class PageControler extends Controler {
	public function IndexAction($params) {
		return $this->redirect("page/list");
	}

	public function ShowAction($params) {
		if(!empty($params[4]))
			$lang = $params[4];
		else
			$lang = $params[0];
		$page = App::getClass("article", $params[3]);
		return $this->render(array('page' => $page, 'lang' => $lang));
	}

	public function AddAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$attr["title"] = array("fr" => $data["title-fr"], "en" => $data["title-en"]);
			$attr["text"] = array("fr" => $data["content-fr"], "en" => $data["content-en"]);
			$attr["author"] = Kernel::get("user")->get("id");
			$attr["node"] = 4;
			if($page = App::getClass("article")->hydrate($attr)->save())
				return $this->redirect(Kernel::getUrl("page/show/".$page->get("id")));
			else
				return $this->render(null);
		}
		else
			return $this->render(null);
	}

	public function DeleteAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$id = $data["id"];
			$page = App::getClass("article", $id);
	
			if($page->set(array("deleted" => true)))
				return $this->redirect(Kernel::getUrl("page/list"));
			else
				return $this->redirect(Kernel::getUrl("page/delete/".$id));
		}
		else {
			$page = App::getClass("article", $params[3]);
			return $this->render(array('page' => $page));
		}
	}

	public function UpdateAction($params) {
		$form = $this->getRequest();
		if($form->isMethod("post")) {
			$data = $form->getData();
			$id = $data["id"];
			$page = App::getClass("article", $id);
			$attr["title"] = array("fr" => $data["title-fr"], "en" => $data["title-en"]);
			$attr["text"] = array("fr" => $data["content-fr"], "en" => $data["content-en"]);
			if($page->set($attr))
				return $this->redirect(Kernel::getUrl("page/show/".$page->get("id")));
			else
				return $this->render(array('page' => $page));
		}
		else {
			$page = App::getClass("article", $params[3]);
			return $this->render(array('page' => $page));
		}
	}

	public function ListAction($params) {
		if(!empty($params[3]))
			$lang = $params[3];
		else
			$lang = $params[0];
		$pages = App::getClassArray("article", array("where" => "node = 4 AND deleted = 0"));
		return $this->render(array('pages' => $pages, 'lang' => $lang));
	}
}

?>