<?php


class LangType implements Type {

	private $langForced;
	private $idLang;

	public function __construct($idLang, $langForced = null) {
		$this->idLang = $idLang;
		$lang = Sql2::create()->from("_orm_lang")->where("id_lang", Sql2::$OPE_EQUAL, $idLang)->fetchArray();
		foreach ($lang as $value) {
			$lang = $value["lang"];
			$this->$lang = $value["translation"];
		}
		$this->langForced = $langForced;
	}

	public function get($params = __lang__) {
		if($params=="id")
			return $this->idLang;
		elseif($params!=null)
			$this->setLang($params);
		else {
			$this->setLang(Kernel::get("lang"));
		}
		return $this;
	}

	public static function getCompare($object, $attribut, $params = null) {
		$data = $object->get($attribut);
		if($params[0] == "Sanitize")
			return Kernel::sanitize($data);
		else
			return $data;
	}

	public function setLang($langForced) {
		$this->langForced = $langForced;
	}

	public static function check($data) {
		$valid = true;
		if(!is_array($data))
			$valid = false;
		foreach ($data as $key => $value) {
			if(empty($value))
				$valid = false;
		}
		return $valid;
	}

	public static function save($data) {
		$id_lang = Sql2::create()->select("MAX(id_lang)")->from("lang")->fetch();
		$id_lang++;
		foreach ($data as $key2 => $value2) { // différentes langues
			Sql2::create()->insert("_lang")->columnsValues(array("id_lang" => $id_lang, "lang" => $key2, "translation" => mysql_real_escape_string($value2)))->execute();
		}
		return $id_lang;
	}
	
	public static function update($object, $attribut, $data) {
		$id_lang = $object->get($attribut, "id");
		$id_lang = intval($id_lang);
		foreach ($data as $key => $value) { // différentes langues
			$value = htmlspecialchars(addslashes($value));
			if(Sql2::create()->select("COUNT(*)")->from("lang")->where("id_lang", "=", $id_lang)->andWhere("lang", "=", $key)->fetch()==1)
				Sql2::create()->update("lang")->columnsValues(array("translation" => $value))->where("id_lang", "=", $id_lang)->andWhere("lang", "=", $key)->execute();
			else {
				Sql2::create()->insert("lang")->columnsValues(array("translation" => $value, "lang" => $key, "id_lang" => $id_lang))->execute();
			}
		}
		return array("-1", $id_lang);
	}

	public function __toString() {
		if($this->langForced !=null)
			$lang = $this->langForced;
		else
			$lang = __lang__;
		if(isset($this->$lang))
			return $this->$lang;
		else
			return "";
	}

}

?>