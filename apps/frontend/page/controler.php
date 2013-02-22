<?php

class PageControler extends Controler {
	public function IndexAction($params) {
		if(!empty($params[3])) {
			$page = App::getTable("article")->getBySanitizeTitle($params[3]);
			if(!empty($page))
				return $this->render(array("page" => $page));
			else
				return $this->redirect(Kernel::getUrl(""));
		}
		else
			return $this->redirect(Kernel::getUrl(""));
	}

	public function ContactAction($params) {
		return $this->render(null);
	}

	public function SitemapAction($params) {
		return $this->render(null);
	}

	public function AboutAction($params) {
		return $this->render(null);
	}

	public function PartnersAction($params) {
		return $this->render(null);
	}
}

?>