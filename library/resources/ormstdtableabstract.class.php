<?php


abstract class OrmStdTableAbstract {
	
	/*
		Cache pour les tables
	*/
	public static $CACHE;

	/*
		Nom de la classe des objets qui constituent la collection
	*/
	public $_name;

	/*
		Collection des objets
	*/
	public $_collection;

	/*
		Types de la classe
	*/
	public $_types;


	/*
		Constructeur
	*/
	public function __construct($param = null) {
		/* Création du cache */
		self::setCache();
			
		/* $_name */
		if($param===null) {
			$param = get_class($this);
			$param = strstr($param, 'Table', true);
			$param = mb_strtolower($param);
		}
		if(is_object($param))
			$param = $param->_class;
		$this->_name = $param;
	}

	/*
		Création de la classe du cache
	*/
	private static function setCache() {
		if(OrmStdTableAbstract::$CACHE==null)
			OrmStdTableAbstract::$CACHE = new Cache(Cache::getDir()."orm", 5);
	}

	/*
		Getter du cache
	*/
	private static function getCache() {
		return OrmStdTableAbstract::$CACHE;
	}

	/*
		Récupère toutes les données de la table avec systeme de cache
	*/
	public function getCollection() {
		if(empty($this->_collection)) {
			$Cache = self::getCache();
			if(!$array = $Cache->read("ORM_collection_".$this->_name)) {
				$array = Sql2::create()->from($this->_name)->fetchArray();
				$Cache->write("ORM_collection_".$this->_name, serialize($array));
			} 
			else
				$array = unserialize($array);
			
			$collection = new Collection();
			foreach ($array as $value) {
				$collection->hydrate(App::getClass($this->_name)->hydrate($value));
			}
			$this->_collection = $collection;
		}
		return $this->_collection;
	}

	/*
		Récupère les types des champs de la classe avec systeme de cache
	*/
	public function getTypes() {
		if(empty($this->_types)) {
			$Cache = self::getCache();
			if(!$types = $Cache->read("ORM_table_".$this->_name)) {
				$types = Sql2::create()->from("_orm_column_type")->where("name_table", Sql2::$OPE_EQUAL, mb_strtolower($this->_name))->fetchArray();
				$Cache->write("ORM_table_".$this->_name, serialize($types));
			} 
			else
				$types = unserialize($types);
			foreach ($types as $value) {
				$this->_types[$value["name_column"]] = $value;
			}
		}
		return $this->_types;
	}

	/*
		Générateur de fonctions génériques
	*/
	public function __call($name, $paramsFunction) {
		return $this->getCollection()->$name($paramsFunction);
		/*if(is_array($paramsFunction[0]))
			$paramsFunction = $paramsFunction[0];
		$nameArray = str_split($name);
		$function = array();
		$cpt=0;
		$function[$cpt] = "";
		foreach ($nameArray as $key => $value) {
			if(ord($value)>=65 && ord($value)<=90) {
				$cpt++;
				$function[$cpt] = "";
			}
			$function[$cpt] .= $value;
		}



		if($function[0] == "get" && isset($function[1])) {
			if($function[1] == "By") {
				$attribut = strtolower($function[count($function)-1]);
				if($attribut != "id") {
					$type = $this->getTypes();
					$type = $type[$attribut];
					$type = explode(" ", $type);
					$params = $function;
					unset($params[0]);
					unset($params[1]);
					unset($params[count($function)-1]);
					$params = array_values($params);

					$collection = $this->getCollection();
					
					$return = $this->search($collection, $type, $attribut, $params, $paramsFunction);

					if($return->count()==0)
						return false;
					elseif($return->count()==1)
						return $return->get(0);
					else
						return $return;
				}
				else {
					if(count($paramsFunction)==1) {
						foreach ($this->getCollection() as $object) {
							if($object->get("id")==$paramsFunction[0])
								return $object;
						}
						return false;
					}
					else {
						$collection = new Collection();
						foreach ($this->getCollection() as $object) {
							foreach ($paramsFunction as $value) {
								if($object->get("id")==$value)
									$collection->hydrate($object);
							}
						}
						if(count($collection) == 0)
							return false;
						else
							return $collection;
					}
				}
			}
			else
				return false;
		}
		else
			return false;
			*/
	}

	/*
		Fonction de recherche pour les getBy génériques
	*//*
	private function search($collection, $type, $attribut, $params, $paramsFunction) {
		if(is_array($paramsFunction[0]))
			$paramsFunction = $paramsFunction[0];
		$return = new Collection();
		foreach ($collection as $object) {
			if($type[0]=="type") {
				$typeClass = ucfirst(strtolower($type[1]))."Type";
				if(in_array($typeClass::getCompare($object, $attribut, $params), $paramsFunction))
					$return->hydrate($object);
			}
			elseif($type[0]=="class") {
				if(empty($params[0])) {
					if(count($paramsFunction)==0)
						$paramsFunction[0] = true;
					if(($paramsFunction[0] && $object->get($attribut)) || (!$paramsFunction[0] && !$object->get($attribut)))
						$return->hydrate($object);
				}
				else {
					if($linkedObject = $object->get($attribut)) {
						$linkedCollection = new Collection();
						$linkedCollection->hydrate($linkedObject);
						$nameFunction = "getBy".implode("", $params);
						$linkedResult = $linkedCollection->$nameFunction($paramsFunction);
						if($linkedResult)
							$return->hydrate($object);
					}
				}
			}
			elseif($type[0]=="collection") {
				if(empty($params[0])) {
					if(count($paramsFunction)==0)
						$paramsFunction[0] = true;
					$links = $object->get($attribut);
					if(($paramsFunction[0] && count($links) > 0) || (!$paramsFunction[0] && count($links) == 0))
						$return->hydrate($object);
				}
				else {
					$linkedCollection = $object->get($attribut);
					if(count($linkedCollection)>0) {
						$nameFunction = "getBy".implode("", $params);
						$linkedResult = $linkedCollection->$nameFunction($paramsFunction);
						if($linkedResult)
							$return->hydrate($object);
					}
				}
			}
		}
		return $return;
	}
*/
	/*
		Création d'un objet et sauvegarde en base
	*/
	public function create($value) {
		$new = App::getClass($this->_name)->hydrate($value);

	}

	public function checkData() {

	}

	public function save() {

	}
}

?>