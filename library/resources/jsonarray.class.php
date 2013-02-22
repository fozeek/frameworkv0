<?php 

class JsonArray {

	private $array;

	public __construct($file) {
		$array = file_get_contents($file);
		$array = json_decode($array);
		$this->array = $array;
	}

	public function get($attribut) {
		return $this->array[$attribut];
	}
}



?>