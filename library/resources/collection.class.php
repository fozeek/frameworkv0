<?php

/*
	Class Collection
	Description : 
		-
		-
*/


class Collection implements Countable, Iterator {

	public $_name;
	var $array;
	var $count;
	var $object = array();
	var $target;
	private $position = 0;

	public function __construct() {
		$this->array = array();
		$this->count = 0;
	}

	public function hydrate($add) {
		if($this->count()==0)
			$this->_name = $add->_class;
		$this->array[] = $add;
		$this->count++;
	}

	public function setObject($object) {
		$this->object["id"] = $object->get("id");
		$this->object["name"] = $object->getClass();
	}
	public function setTarget($class) {
		$this->target = $class;
	}

	/*
		Ajoute un objet a une collection
	*/
	public function add() {
		if(count($this->object)>0) {

		}
		else
			return new Error(1);
	}
	
	public function remove() {
		if(count($this->object)>0) {


		}
		else
			return new Error(1);
	}

	public function get($rang=0) {
		if($rang>=0 && $rang <= $this->count)
			return $this->array[$rang];
		else
			return new Error(1);
	}

	public function count() {
		return $this->count;
	}

	public function rewind() {
		$this->position=0;
	}
	public function key() {
		return $this->position;
	}
	public function current() {
		return $this->array[$this->position];
	}
	public function next() {
		++$this->position;
	}
	public function valid() {
		return isset($this->array[$this->position]);
	}

	public function __call($name, $paramsFunction) {
		if(is_array($paramsFunction[0]))
			$paramsFunction = $paramsFunction[0];
		/* traitement du nom de la fonction */
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
					
					$type = App::getTable($this->_name)->getTypes();
					$type = $type[$attribut];
					$type = explode(" ", $type);
					$params = $function;
					unset($params[0]);
					unset($params[1]);
					unset($params[count($function)-1]);
					$params = array_values($params);

					$collection = $this;

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
						foreach ($this as $object) {
							if($object->get("id")==$paramsFunction[0])
								return $object;
							else
								return false;
						}
					}
					else {
						$collection = new Collection();
						foreach ($this as $object) {
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
	}

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
					if(($paramsFunction[0] && $object->get($attribut)) || (!$paramsFunction[0] && !$object->get($attribut))) {
						$return->hydrate($object);
					}
				}
				else {
					if($linkedObject = $object->get($attribut)) {
						$linkedCollection = new Collection();
						$linkedCollection->hydrate($linkedObject);
						$nomFunction = "getBy".$params;
						$linkedResult = $linkedCollection->$nameFunction($paramsFunction);
						if(count($linkedResult) > 0)
							$return->hydrate($object);
					}
				}
			}
			elseif($type[0]=="collection") {
				if(empty($params[0])) {
					if(count($paramsFunction)==0)
						$paramsFunction[0] = true;
					if(Sql2::table_exist($this->_name."_".$type[1]))
						$nomTable = $this->_name."_".$type[1];
					elseif(Sql2::table_exist($type[1]."_".$this->_name))
						$nomTable = $type[1]."_".$this->_name;
					$links = Sql2::create()->from($nomTable)->where("id_".$this->_name, "=", $object->get("id"))->fetchArray();
					if(($paramsFunction[0] && count($links) > 0) || (!$paramsFunction[0] && count($links) == 0))
						$return->hydrate($object);
				}
				else {
					if($linkedCollection = $object->get($attribut)) {
						$nomFunction = "getBy".$params;
						$linkedResult = $linkedCollection->$nameFunction($paramsFunction);
						if(count($linkedResult) > 0)
							$return->hydrate($object);
					}
				}
			}
		}
		return $return;
	}

	public function options($params = null) {
		return $this;
	}

	public function sort() {
		return $this;
	}

}