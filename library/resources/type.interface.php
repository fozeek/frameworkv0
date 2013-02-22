<?php


interface Type {
	public static function check($data);
	public function get($params);
	public function __construct($data, $params);
	public static function save($data);
	public function __toString();
	public static function getCompare($object, $attribut, $params);
	public static function update($object, $attribut, $params);
}



?>