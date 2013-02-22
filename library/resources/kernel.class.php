<?php

class Kernel {
	public static $CODE_LANG = 0;
	public static $CODE_CONTROLER = 1;
	public static $CODE_ACTION = 2;
	public static $CODE_PARAM = 3;

	public static $CONTROLER_WITHOUT_NEEDS = array("error");

	public static $PDO;
	public static $APP;
	public static $CONTROLER;
	public static $ACTION;
	public static $LANG;
	public static $LANGS;
	public static $LANG_DEFAULT;
	public static $SESSION;
	public static $RESPONSE;
	public static $URL;
	public static $CACHE;
	public static $PARAMS;


	static public function get($attr) {
		if($attr=="app")
			return __app__;
		elseif($attr=="controler")
			return Kernel::$CONTROLER;
		elseif($attr=="action")
			return Kernel::$ACTION;
		elseif($attr=="session")
			return Kernel::$SESSION;
		elseif($attr=="lang")
			return Kernel::$LANG;
		elseif($attr=="url")
			return Kernel::$URL;
		elseif($attr=="langs")
			return Kernel::$LANGS;
		elseif($attr=="langdefault")
			return Kernel::$LANG_DEFAULT;
		elseif($attr=="params")
			return Kernel::$PARAMS;
		elseif($attr=="cache")
			return Kernel::$CACHE;
		elseif($attr=="user")
			return Kernel::$SESSION->getUser();
		else
			return new Error(1);
		
	}

	public function __construct($_KERNEL_DEBUG_, $_LANG_ACCEPTED_, $_LANG_DEFAULT_) {
		$this->_KERNEL_DEBUG_ = $_KERNEL_DEBUG_;
		$this->_LANG_ACCEPTED_ = $_LANG_ACCEPTED_;
		$this->_LANG_DEFAULT_ = $_LANG_DEFAULT_;
		Kernel::$LANG = $_LANG_DEFAULT_;
		Kernel::$LANG_DEFAULT = $_LANG_DEFAULT_;
		Kernel::$LANGS = $this->_LANG_ACCEPTED_;

		try { 
		    $conn = new PDO('mysql:host='.__SQL_hostname__.';dbname='.__SQL_db__, __SQL_user__,  __SQL_password__, array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		    Kernel::$PDO = $conn;
		} catch(PDOException $e) {
		    echo 'ERREUR: ' . $e->getMessage(); 
		}

		
	}


	public function startSession() {
		Kernel::$SESSION = new Session();
	}

	public function startCache($folder, $time = null) {
		if($time == null)
			$time = 60;
		Kernel::$CACHE = new Cache($folder, $time);
	}

	private function set($attr, $value) {
		$this->$attr = $value;
	}

	private function parse($url) {
		$firstUrl = $url;
		$lang = explode("/", $firstUrl);
		$lang = $lang[0];
		Kernel::$LANG = $lang;
		if(!in_array($lang, self::$LANGS)) {
			$lang = self::$LANG_DEFAULT;
			self::$LANG = $lang;
			header("Location:/".$lang."/".$url);
		}
		define("__lang__", self::$LANG);

		// On enleve la langue
		$urlTmp = explode("/", $url);
		if(in_array($urlTmp[0], self::$LANGS)) {
			$urlTmp[0] = "";
			$url = implode("/", $urlTmp);
			$url = ltrim($url, "/");
		}

		$url = $this->setUrl($url);
		self::$URL = $url;
		$url = $lang."/".$url;
		
		if(!empty($url))
			$tmp = explode("/", $url);
		else
			$tmp = array();
		return $tmp;
	}

	private function dispatcher($route) {
		// Appel de l'app et du controler
		if(!empty($route[Kernel::$CODE_CONTROLER]) && in_array($route[Kernel::$CODE_CONTROLER], Kernel::$CONTROLER_WITHOUT_NEEDS)) {
			$appRoute = array($route[Kernel::$CODE_CONTROLER], $route[Kernel::$CODE_ACTION]);
			$return = new Response(Response::$STATUS_404, $appRoute);
			Kernel::$RESPONSE = $return;
			
		}
		else {
			if(empty($route[Kernel::$CODE_CONTROLER]))
				$route[Kernel::$CODE_CONTROLER] = "home";
			$bundleName = ucfirst($route[Kernel::$CODE_CONTROLER])."Controler";
			$bundle = new $bundleName();
			if(empty($route[Kernel::$CODE_ACTION]) || is_numeric($route[Kernel::$CODE_ACTION])) 
				$route[Kernel::$CODE_ACTION] = "index";
			$controlerName = $route[Kernel::$CODE_ACTION]."Action";
			$controlerName = ucfirst($controlerName);
			if(!method_exists($bundle,$controlerName)) {
				header("Location:".Kernel::getUrl("error/404"));
			}

			$params = array();
			foreach ($route as $key => $value) {
				$params[] = $value;
			}
			
			$return = $bundle->$controlerName($route);
			Kernel::$RESPONSE = $return;
			if($return->hasRoute())
				$appRoute = $return->getRoute();
			else 
				$appRoute = array($route[Kernel::$CODE_CONTROLER], $route[Kernel::$CODE_ACTION]);
		}

		if(!empty($appRoute[0]))
			Kernel::$CONTROLER = $appRoute[0];
		else
			Kernel::$CONTROLER =  "home";
		if(!empty($appRoute[1]))
			Kernel::$ACTION = $appRoute[1];
		else
			Kernel::$ACTION = "index";
		return $return;
	}

	public function setKernel($url) {
		$url = $this->parse($url);
		// auto-save des posts
		Kernel::get("session")->saveRequest();
		return $this->dispatcher($url);
	}

	public static function getUrl($url) {
		if($url=="") {
			return "/".Kernel::get("lang")."/";
		}
		$urlTmp = explode("/", $url);
		if(in_array($urlTmp[0], Kernel::get("langs"))) {
			$lang = $urlTmp[0];
			$urlTmp[0] = "";
			$url = implode("/", $urlTmp);
			$url = ltrim($url, "/");
		}
		else {
			$lang = Kernel::get("lang");
		}
		if($url=="") {
			return "/".$lang."/";
		}
		$urlExplode = explode("/", $url);
		$controler = $urlExplode[0];
		$action = $urlExplode[1];
		$data = Sql2::create()->select("matchurl")
				      ->from("urlrewriting")
				      ->where("app", "=", __app__)
				      ->andWhere("lang", "=", $lang)
				      ->andWhere("controler", "=", $controler)
				      ->andWhere("routeorder", "=", 0)
				      ->andWhere("action", "=", $action)->fetch();
		
		$route_order_max = Sql2::create()->select("MAX(routeorder)")
				    	 ->where("app", "=", __app__)
				    	 ->andWhere("lang", "=", $lang)
						 ->from("urlrewriting")->fetch();
		
		$i = 1;
		while(!$data && $i <= $route_order_max){
		    $data = Sql2::create()->select("matchurl")
					->from("urlrewriting")
				    ->where("app", "=", __app__)
				    ->andWhere("lang", "=", $lang)
					->andWhere("controler", "=", $controler)
					->andWhere("routeorder", "=", $i)
					->andWhere("action", "=", $action)->fetch();
		    $i++;
		}
		
		if($data) {
			$url = $data;
			$params = $urlExplode;
			unset($params[0]);
			unset($params[1]);
			$params = array_values($params);
			foreach ($params as $key => $value) {
				$url = str_replace("{".($key+1)."}", Kernel::sanitize($value), $url);
			}
		}
		return "/".$lang."/".$url;
	}

	public static function sanitize($string) {
		$string = mb_strtolower($string, 'UTF-8');
		$string = str_replace(
			array(
				'à', 'â', 'ä', 'á', 'ã', 'å',
				'î', 'ï', 'ì', 'í',
				'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
				'ù', 'û', 'ü', 'ú',
				'é', 'è', 'ê', 'ë',
				'ç', 'ÿ', 'ñ',
			),
			array(
				'a', 'a', 'a', 'a', 'a', 'a',
				'i', 'i', 'i', 'i',
				'o', 'o', 'o', 'o', 'o', 'o',
				'u', 'u', 'u', 'u',
				'e', 'e', 'e', 'e',
				'c', 'y', 'n',
			),
			$string
		);
		$string = str_replace(" ", "-", $string);
		$string = str_replace("'", "-", $string);
		$string = str_replace(",", "-", $string);
		$string = str_replace("?", "-", $string);
		$string = str_replace("!", "-", $string);
		$string = str_replace(":", "-", $string);
		$string = str_replace(";", "-", $string);
		$string = str_replace("--", "-", $string);
		$string = rtrim($string, "-");
		$string = ltrim($string, "-");
		return $string;
	}

	public static function BBcode($string) {
		$tmp = str_split($string);
		$spec = false;
		$inter = false;
		$buffer_inter = "";
		$buffer_spec = "";
		$return = "";
		foreach ($tmp as $car) {
			if(!$spec && !$inter) {
				if($car=="[") {
					$spec = true;
					$buffer_spec = "";
				}
				else {
					$return .= $car;
				}
			}
			elseif($spec) {
				
				if($car=="]") {
					
					if($buffer_spec=="/link") {
						$return .= "$buffer_inter\">$buffer_inter</a>";
					}
					elseif($buffer_spec=="link") {
						$return .= "<a target=\"_BLANK\" href=\"";
					}
					elseif($buffer_spec=="/i") {
						$return .= "$buffer_inter</i>";
					}
					elseif($buffer_spec=="i") {
						$return .= "<i>";
					}
					elseif($buffer_spec=="/strong") {
						$return .= "$buffer_inter</strong>";
					}
					elseif($buffer_spec=="strong") {
						$return .= "<strong>";
					}
					elseif($buffer_spec=="/u") {
						$return .= "$buffer_inter</u>";
					}
					elseif($buffer_spec=="u") {
						$return .= "<u>";
					}


					$buffer_spec = "";
					if(!empty($buffer_inter)) {
						$inter = false;
						$spec = false;
						$buffer_inter = "";
					}
					else {
						$inter = true;
						$spec = false;
					}
				}
				else
					$buffer_spec .= $car;
			}
			elseif($inter) {
				if($car=="[") {
					$inter = false;
					$spec = true;
				} 
				else
					$buffer_inter .= $car;
			}
		}
		return $return;
	}

	private function setUrl($url) {
		$data = Sql2::create()->from("urlrewriting")
				      ->where("app", "=", __app__)
				      ->andWhere("lang", "=", Kernel::get("lang"))
				      ->orderBy("routeorder", "ASC")
				      ->fetchArray();
		
		foreach ($data as $key => $value) {
			foreach ($value as $key2 => $value2) {
				if(is_integer($key2) || $key2 == "id")
					unset($data[$key][$key2]);
			}
			$pattern = $value["matchurl"];
			$bool = true;
			$cpt = 1;
			do {
				$search = "{".$cpt."}";
				if(strpos($pattern, $search)) {
					$pattern = str_replace($search, "(.*)", $pattern);
				}
				else
					$bool = false;
				$cpt++;
			} while($bool);
			$data[$key]["regex"] = "/".addcslashes($pattern, "/")."/i";
			$data[$key]["nbparams"] = $cpt-2; 
		}

		$found_array = array();
		$found = null;
		foreach ($data as $key => $value) {
			if(preg_match($data[$key]["regex"], $url))
				$found_array[] = $data[$key];
		}
		if(count($found_array) == 0) {
			return $url;
		}
		reset($found_array);
		$found = current($found_array);
		
		$paramsName = array();
		$tmp = explode("{", $found["matchurl"]);
		foreach ($tmp as $key => $value) {
			if($key != 0) {
				$rang = strpos($value, "}");
				$search = strtok($value, "}");
				$paramsName[] = $search;
				$search .= "}";
				$tmp[$key] = str_replace($search, "", $value);
			}
		}
		foreach ($tmp as $key => $value) {
			$url = str_replace($value, "/", $url);
		}
		$params = explode("/", $url);
		foreach ($params as $key => $value) {
			if($value == "")
				unset($params[$key]);
		}
		$params = array_values($params);
		$newUrl = $found["controler"]."/".$found["action"];
		foreach ($paramsName as $value) {
			$newUrl .= "/".$params[$value-1];
		}
		return $newUrl;
	}
}

?>