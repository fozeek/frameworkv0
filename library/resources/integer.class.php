<?php


class IntegerType implements Type {
	
	private $_attribut;

	public static function check($data) {
		$valid = true;
		if(!is_numeric($data))
			$valid = false;
		return $valid;
	}

	public function __construct($data, $params = null) {
		$this->_attribut = $data;
		return $this;
	}

	public function get($params = null) {
		return $this;
	}

	public static function getCompare($object, $attribut, $params = null) {
		return $object->$attribut;
	}

	public static function save($data) {
		return $data;
	}

	public static function update($object, $attribut, $params = null) {
		return $object->get($attribut);
	}

	public function __toString() {
		return $this->_attribut."";
	}

}

?>