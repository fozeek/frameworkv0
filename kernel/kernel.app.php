<?php
	spl_autoload_register(function ($class) {
	    if (strstr($class, "Controler")) { // Autoloader des controller
		    if(file_exists(__apps_dir__.__app__.'/'.str_replace("controler", "",mb_strtolower($class)).'/index.php')) // Debug for class_exists()
				require_once(__apps_dir__.__app__.'/'.str_replace("controler", "",mb_strtolower($class)).'/index.php');
			else {
				header("Location:".Kernel::getUrl("error/404"));
				die();
			}
		} 
		else { // Autoloader du modele
			 if(file_exists(__library_dir__.'modele/'.mb_strtolower($class).'.class.php')) // Debug for class_exists()
				require_once(__library_dir__.'modele/'.mb_strtolower($class).'.class.php');
		}
	});



	/*
		Mise en route du kernel
	*/

	/* Création du kernel */
	$_kernel = new Kernel($_KERNEL_DEBUG_, $_LANG_ACCEPTED_, $_LANG_DEFAULT_);

	/*
		Gestion de l'utilisateur
		Commentaires :
			- Commente this line if you don't want to use session
	*/
	$_kernel->startSession();

	/*
		Gestion du cache pour les themes
	*/
	$_kernel->startCache(Cache::getDir()."kernel", 60);

	/*
		Appel de l'application et du controller par routing
	*/
	if(!empty($_GET["url"]))
	    $url = $_GET["url"];
	else 
	    $url = "";
	
	$response = $_kernel->setKernel($url);
	$url = "";
	/*
		Mise à disposition des variables pour le thème et gestion des erreurs.
	*/
	if(get_class($response)!="Error") {
		if($response->getStatus()==Response::$STATUS_REDIRECT) {
			header("Location:".$response->getRoute());
			die();
		}
		elseif($response->getStatus()==Response::$STATUS_XML) {
			$type = $response->getVars();
			$type = $type["type"];
			if($type=="RSS"){
				$Cache = Kernel::get("cache");
				$name = $response->getVars();
				$name = $name["name"];
				header('Content-type: text/xml');
				if(!$fichier = $Cache->start("RSS".$name)) {
					$_params = Kernel::get("params");
					$params = $response->getVars();
					$params = $params["params"];
					include(__library_dir__.'kernel_templates/rss.php');
				} 
				$Cache->end();
				die();
			}
		}
		else {
			unset($_kernel);
			if($response->hasVars())
				extract($response->getVars());
			$params = Kernel::get("params");
			require_once(__themes_dir__.'default/index.php');
		}
	}
?>