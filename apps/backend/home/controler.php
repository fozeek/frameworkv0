<?php


class HomeControler extends Controler {
	public function IndexAction($params) {
		/*$notifications = App::getClassArray("article", array("where" => "node = 3", "orderBy" => array("date", "DESC")));
		
		App::getClass("article", 2)->get("node");

		$test = App::getTable("article")->getBySanitizeNameCategory("developpement-fonctionnel");
		echo "<pre>";
		print_r($test);
		echo "</pre>";
		die();
		return $this->render(array('notifications' => $notifications));*/
		echo "<pre>";
		//print_r(App::getTable("taxonomy")->getCollection());
		foreach (App::getTable("taxonomy")->getCollection() as $value) {
			print_r($value->get("description", "en"));
			echo "<br />";
		}
		echo "</pre>";
		die();
	}

	public function ConnectAction($params) {
		if(Kernel::get("user") == false){
		    $form = $this->getRequest();
		    if($form->isMethod("post")) {
				$data = $form->getData();
				
				$bool_error = false;
				$error = array();

				$attr = array();
				$attr["pseudo"] = strtolower(htmlspecialchars($data["pseudo"]));
				$attr["password"] = htmlspecialchars($data["password"]);
				
				if(strlen($attr["pseudo"]) < 6){
				    $bool_error = true;
				    $error["pseudo"] = "error";
				}
				if(strlen($attr["password"]) < 6){
				    $bool_error = true;
				    $error["password"] = "error";
				}
				if($bool_error){
				    return $this->render(array("error" => $error, "attr" => $attr));
				}
				else {
				    if($user = App::getTable("user")->getBySanitizePseudo($attr["pseudo"])) {
					
					if($user->access("ACCESS_BO")){
					    if($user->get("password") == md5($attr["password"])){
						Kernel::get("session")->connect($user);
						return $this->redirect(Kernel::getUrl(""));
					    }
					    else {
						$error["bad_login"] = "error";
						return $this->render(array("error" => $error));
					    }
					}
				    }
				    else{
					$error["bad_login"] = "error";
					return $this->render(array("error" => $error));
				    }
				}
		    }

		    return $this->render(null);
		}
		else {
		    return $this->redirect(Kernel::getUrl(""));
		}
	}

	public function DisconnectAction($params) {
		Kernel::get("session")->disconnect();
		return $this->redirect(Kernel::getUrl(""));
	}
}

?>