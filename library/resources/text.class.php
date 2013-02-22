<?php


class TextType implements Type {
	
	private $_attribut;

	public static function check($data) {
		$valid = true;
		if(!is_string($data))
			$valid = false;
		return $valid;
	}

	public function __construct($data, $params = null) {
		$this->_attribut = $data;
		return $this;
	}

	public static function getCompare($object, $attribut, $params = null) {
		return $object->$attribut;
	}

	public function get($params = null) {
		if($params)
			return Kernel::sanitize($this);
		else
			return $this;
	}

	public static function save($data) {
		$text = Kernel::$PDO->quote(htmlspecialchars($data));
		$text = trim($text, "\'");
		return $text;
	}

	public static function update($object, $attribut, $data = null) {
		$text = Kernel::$PDO->quote(htmlspecialchars($data));
		$text = trim($text, "\'");
		return $text;
	}

	public function __toString() {
		return $this->_attribut."";
	}

}

?>