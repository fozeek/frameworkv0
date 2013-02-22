<?php


class BooleanType implements Type {
	
	private $_attribut;

	public static function check($data) {
		$valid = true;
		if(is_bool($data)) {
			if($data)
				$data = 1;
			else
				$data = 0;
		}
		if($data!=0 && $data!=1)
			$valid = false;
		return $valid;
	}

	public function __construct($data, $params = null) {
		$this->_attribut = $data;
		return $this;
	}

	public function get($params = null) {
		if($this->_attribut)
			return true;
		else
			return false;
	}

	public static function getCompare($object, $attribut, $params = null) {
		return $object->$attribut;
	}

	public static function save($data) {
		// Mise en forme pour la BDD
		if(is_bool($data)) {
			if($data)
				return 1;
			else
				return 0;
		}
		else
			return $data;
	}

	public static function update($object, $attribut, $data) {
		if($data=="true") {
			return '1';
		}
		elseif($data=="false") {
			return '0';
		}
	}

	public function __toString() {
		return $this->_attribut."";
	}

}

?>