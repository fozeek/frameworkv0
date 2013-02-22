<?php

abstract class Controler {

	private $cache;

	/*
		Cache
		Description : Permet de créer le systeme de cache pour le controller dans le dossier approprié.
	*/
	public function setCache($dirname, $duration = 60) { // Cache de 60 minutes par défault
		$this->cache = new Cache(Cache::getDir().__app__."/".$dirname, $duration);
	}

	/*
		Pour renvoyer vers la vue avec les informations necessaires.
	*/
	public function render($vars, $route=null) {
		return new Response(Response::$STATUS_HTTP, $route, $vars);
	}

	/*
		Pour renvoyer un fichier json de $array
	*/
	public function renderJson($array) {
		return new Response(Response::$STATUS_HTTP, $route, $vars);
	}

	/*
		Pour renvoyer un fichier XML avec les parametres de params (ex : RSS)
	*/
	public function renderRSS($name, $params) {
		//http://sebsauvage.net/comprendre/rss/creer.html
		$route = null;
		return new Response(Response::$STATUS_XML, $route, array("type" => "RSS", "name" => $name, "params" => $params));
	}

	/*
		Pour faire une redirection
	*/
	public function redirect($url) {
		return new Response(Response::$STATUS_REDIRECT, $url);
	}

	/*
		Permet de retourner l'objet Request pour les formulaires
	*/
	public function getRequest() {
		return new Request();
	}

}

?>