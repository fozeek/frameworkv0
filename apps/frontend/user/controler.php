<?php

class UserControler extends Controler {
	public function IndexAction($params) {
		/*
			if($user = Kernel->get("session")) {
				return $this->render(array('user' => $user), array("user", "profil"));
			}
			else {
				return $this->redirect(....);
			}

		*/

		return $this->render(array('user' => null), array("user", "profil"));
	}
	
	public function ProfilAction($params) {
	    $user = App::getTable("user")->getBySanitizePseudo(strtolower($params[3]));

	    if($user){

		$image = "";

		if($user->get("image") != null){
		    $image = "IN_USER";
		}
		else {
		    $image = md5(strtolower(trim($user->get("mail"))));
		}

		return $this->render(array('user' => $user, "image" => $image));
	    }
	    else{
		return $this->redirect(Kernel::getUrl("error/404"));
	    }
	}
	
	public function SubscriptionAction($params) {
		if(Kernel::get("user") == false){
		    $form = $this->getRequest();
		    if($form->isMethod("post")) {
			$data = $form->getData();

			$languages = array("", "html", "css", "php", "csharp", "asp", "javascript", "jquery");
			$civility = array("homme", "femme");
			$mail = "/[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-zA-Z]+/";
			$url = "/((http:\/\/|https:\/\/)(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)/";

			$bool_error = false;
			$error = array();

			$attr = array();
			$attr["pseudo"] = strtolower(htmlspecialchars($data["pseudo"]));
			$attr["name"] = htmlspecialchars($data["name"]);
			$attr["surname"] = htmlspecialchars($data["firstname"]);
			$attr["mail"] = htmlspecialchars($data["email"]);
			$attr["datesignin"] = date("Y-m-d H:i:s");
			$attr["civility"] = htmlspecialchars($data["civilite"]);			
			$attr["password"] = htmlspecialchars($data["password"]);
			$attr["country"] = htmlspecialchars($data["pays"]);
			$attr["city"] = htmlspecialchars($data["city"]);
			$attr["site"] = htmlspecialchars($data["site"]);
			$attr["deleted"] = 0;
			$attr["banned"] = 0;
			$attr["image"] = 0;
			$attr["access"] = 0;
			$attr["languages"] = htmlspecialchars($data["langage"]);

			$languages_array = explode(',', $attr["languages"]);
			
			if(count($error) > 0)
			    $bool_error = true;
			
			if(strlen($attr["pseudo"]) < 6){
			    $bool_error = true;
			    $error["pseudo"] = "error";
			}
			else if(App::getTable("user")->getBySanitizePseudo($attr["pseudo"])){
			    $bool_error = true;
			    $error["pseudo_exist"] = "error";
			}
			if(strlen($attr["name"]) < 1){
			    $bool_error = true;
			    $error["name"] = "error";
			}
			if(strlen($attr["surname"]) < 1){
			    $bool_error = true;
			    $error["surname"] = "error";
			}
			if(!preg_match($mail, $attr["mail"])){
			    $bool_error = true;
			    $error["mail"] = "error";
			}
			if(!in_array($attr["civility"], $civility) ){
			    $bool_error = true;
			    $error["civility"] = "error";
			}
			if(strlen($attr["password"]) < 6){
			    $bool_error = true;
			    $error["password"] = "error";
			}
			if(!preg_match($url, $attr["site"]) && strlen($attr["site"]) > 0){
			    $bool_error = true;
			    $error["site"] = "error";
			}
			foreach($languages_array as $language){
			    if(!in_array($language, $languages) ){
				$bool_error = true;
				$error["languages"] = "error";
			    }
			}
			if($bool_error){
			    return $this->render(array("error" => $error, "attr" => $attr));
			}
			else {
			    $attr["password"] = md5($attr["password"]);

			    if($user = App::getClass("user")->hydrate($attr)->save()){
				Kernel::get("session")->connect($user);
				Kernel::get("session")->set("first_connection", true);
				return $this->redirect(Kernel::getUrl("user/profil/".$user->get("pseudo")));
			    }
			    else
				return $this->render(array("error" => "Vous n'avez pas bien rempli le formulaire"));
			}
		    }
		    else {
			return $this->render(array('user' => null));
		    }
		}
		else {
		    return $this->redirect(Kernel::getUrl("user/profil/".Kernel::get("user")->get("pseudo")));
		}
	}
	
	public function ConnectionAction($params) {
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
				if($user->get("password") == md5($attr["password"])){
				    Kernel::get("session")->connect($user);
				    return $this->redirect(Kernel::getUrl("user/profil/".$user->get("pseudo")));
				}
				else {
				    $error["bad_login"] = "error";
				    return $this->render(array("error" => $error, "attr" => $attr));
				}
			    }
			    else{
				$error["bad_login"] = "error";
				return $this->render(array("error" => $error, "attr" => $attr));
			    }
			}
		    }

		    return $this->render(array('user' => null));
		}
		else {
		    return $this->redirect(Kernel::getUrl("user/profil/".Kernel::get("user")->get("pseudo")));
		}
	}
	
	public function DisconnectAction($params){
	    Kernel::get("session")->disconnect();
	    return $this->redirect("/");
	}
	
	public function CompteAction($params){
	    if(Kernel::get("user") == false){
		return $this->redirect(Kernel::getUrl("home/index"));
	    }
	    else {
		$user = Kernel::get("user");
		
		$form = $this->getRequest();
		if($form->isMethod("post")) {
		    $data = $form->getData();
		    
		    $languages = array("", "html", "css", "php", "csharp", "asp", "javascript", "jquery");
		    $civility = array("homme", "femme");
		    $mail = "/[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-zA-Z]+/";
		    $url = "/((http:\/\/|https:\/\/)(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)/";

		    $bool_error = false;
		    $error = array();

		    $attr = array();
		    $attr["pseudo"] = htmlspecialchars($data["pseudo"]);
		    $attr["name"] = htmlspecialchars($data["name"]);
		    $attr["surname"] = htmlspecialchars($data["firstname"]);
		    $attr["mail"] = htmlspecialchars($data["email"]);
		    $attr["civility"] = htmlspecialchars($data["civilite"]);
		    $attr["country"] = htmlspecialchars($data["pays"]);
		    $attr["city"] = htmlspecialchars($data["city"]);
		    $attr["site"] = htmlspecialchars($data["site"]);
		    //$attr["deleted"] = 0;
		    //$attr["banned"] = 0;
		    //$attr["image"] = 0;
		    //$attr["access"] = 0;
		    $attr["languages"] = htmlspecialchars($data["langage"]);

		    $languages_array = explode(',', $attr["languages"]);

		    if(strlen($attr["pseudo"]) < 6){
			$bool_error = true;
			$error["pseudo"] = "error";
		    }
		    else if($user_bis = App::getTable("user")->getBySanitizePseudo($attr["pseudo"])){
			
			if($user->get("id") != $user_bis->get("id")){
			    $bool_error = true;
			    $error["pseudo_exist"] = "error";
			}
		    }
		    if(strlen($attr["name"]) < 1){
			$bool_error = true;
			$error["name"] = "error";
		    }
		    if(strlen($attr["surname"]) < 1){
			$bool_error = true;
			$error["surname"] = "error";
		    }
		    if(!preg_match($mail, $attr["mail"])){
			$bool_error = true;
			$error["mail"] = "error";
		    }
		    if(!in_array($attr["civility"], $civility) ){
			$bool_error = true;
			$error["civility"] = "error";
		    }
		    if(!preg_match($url, $attr["site"]) && strlen($attr["site"]) > 0){
			$bool_error = true;
			$error["site"] = "error";
		    }
		    foreach($languages_array as $language){
			if(!in_array($language, $languages) ){
			    $bool_error = true;
			    $error["languages"] = "error";
			}
		    }
		    if($bool_error){
			return $this->render(array("user" => $user, "error" => $error, "attr" => $attr));
		    }
		    else {
			$id = intval($data["id"]);

			if(App::getClass("user", $id)->set($attr)){
			    
			    return $this->redirect(Kernel::getUrl("user/compte"));
			}
			else{
			    return $this->render(array("user" => $user, "attr" => $attr));
			}
		    }
		}
		else {
		    $attr["name"] = $user->get("name");
		    $attr["surname"] = $user->get("surname");
		    $attr["pseudo"] = $user->get("pseudo");
		    $attr["mail"] = $user->get("mail");
		    $attr["city"] = $user->get("city");
		    $attr["site"] = $user->get("site");
		}
		
		return $this->render(array('user' => $user, "attr" => $attr));
	    }
	}
	
	
}

?>