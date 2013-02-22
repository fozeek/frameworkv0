<?php

/*
	Class OrmStdAbstract
	Description : 
		-
		-
*/

abstract class OrmStdAbstract {

	/*
		Cache des classes
	*/
	private static $CACHE = null;

	/*
		Nom de la classe
	*/
	private $_class;

	/*
		Tableau des attributs de la classe
	*/
	private $_attributes = array();

	/*
		Getter pour l'objet
	*/
	public function __get($name) {
		if($name[0]=="_")
			return $this->$name;
		else
			return $this->_attributes[$name];
	}

	/*
		Setter pour l'objet
	*/
	public function __set($name, $value) {
		if($name[0]=="_")
			$this->$name = $value;
		else
			$this->_attributes[$name] = $value;
	}

	/*
		Constructeur
	*/
	public function __construct($class) {
		// Set le nom de la classe de l'objet
		$this->_class = $class;
		return $this;
	}

	/*
		Retourne le nom de la classe de l'objet
	*/
	public function getClass() {
		return $this->_class;
	}

	/*
		Retourne les types de la classe
	*/
	public function getTypes($attribut = null) {
		$types = App::getTable($this->_class)->getTypes();
		if($attribut != null && $attribut != "id")
			return $types[$attribut];
		elseif($attribut != null && $attribut == "id")
			return false;
		else
			return $types;
	}

	/*
		Permet de recupérer le cache
	*/
	public function getCache() {
		if(OrmStdAbstract::$CACHE==null)
			OrmStdAbstract::$CACHE = new Cache(Cache::getDir()."orm", 60);
		return OrmStdAbstract::$CACHE;
	}

	/* 
		Getter 
	*/
	public function get($attribut, $params = null) {
		// Création des attributs
		if($this->getTypes($attribut) && !is_object($this->$attribut)) {
			$type = $this->getTypes($attribut);
			if($type["type"]=="class")
				$this->$attribut = App::getTable($type["class"])->getById($this->$attribut);
			elseif ($type["type"]=="collection")
				$this->setCollection($attribut, $type["class"], $params);
			elseif($type["type"]=="type") {
				$type = $type["class"]."Type";
				$this->$attribut = new $type($this->$attribut, $params);
			}
		}
		// Getters spéciaux
		if($type = $this->getTypes($attribut)) {
			if($type["type"]=="type")
				return $this->$attribut->get($params);
			elseif($type["type"]=="collection")
				return $this->$attribut->options($params);
			/*
				Faire un systeme pour faire des getter spéciaux pour les classes du modèle
			*/
		}
		return $this->$attribut;		
	}

	/* Hydrate l'objet */
	public function hydrate($id) {
		if(is_array($id)) {
			foreach ($id as $attribut => $valeur) {	
				if(!is_numeric($attribut)) {
					$this->$attribut = $valeur;
				}
			}
			return $this;
		}
		else
			return false;
	}

	public function checkData() {
		if(empty($this->id)) {
			$types = $this->getTypes();
			$valid = true;
			foreach ($this->getTypes() as $key => $value) {
				if(!empty($this->$key)) {	
					$type = $value;
					if($type[0] == "type") {
						$typeName = $type[1]."Type";
						if(!$typeName::check($this->$key))
							$valid = false;
					}
					if($type[0] == "class") {
						if(!is_numeric($this->$key)) {
							$valid = false;
						}
					}
					if($type[0] == "collection") {
						if(!empty($this->$key)) {
							$valid = false;
						}
					}
					/*if(!$valid)
						echo $key."[".$value."]";*/
				}
			}
			return $valid;
		}
		else
			return false;
	}

	public function save() {
		if(empty($this->id)) {
			if($this->checkData()) {
				// enregistrement des langues
				foreach ($this->getTypes() as $key => $value) {
					if(array_key_exists($key, $this->_attributes)) {
						$types = $value;
						if($types[0]=="type") {
							$type = $types[1]."Type";
							$this->$key = $type::save($this->$key);
						}
					}
				}
				if($id = Sql2::create()->insert($this->_class)->columnsValues($this->_attributes)->execute())
					return Sql2::create()->from($this->_class)->where("id", Sql2::$OPE_EQUAL, $id)->fetchClass();
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}


	/*
		Peut prendre 3 types de syntaxe en parametres

		set("collonne", "value"); // valeurs String
		set(array("collonne1", "collonne2"), array("value1", "value2")); // Deux tableaux
		set(array("collonne1" => "value1", "collonne2" => "value2")); // Tableau associatif

	*/
	public function set($columns, $values=null) {
		if($this->id!="") {

			
			$novalues = false;	// Variable pour forcer le faite de ne pas prendre en compte $values
			if(!is_array($columns))
				$columns = array($columns);
			else {
				if(is_assoc($columns)) {
					$novalues = true;
					$tmpTab = $columns;
					$columns = array();
					foreach ($tmpTab as $key => $value) {
						$columns[] = $key;
						$values[] = $value;
					}
				}
				else {
					if($values == null && sizeof($columns) == sizeof($values) && sizeof($values)>0)
						return new Error(7);
				}
			}
			if(!$novalues) {
				if($values!=null) {
					if(!is_array($values))
						$values = array($values);
					else {
						if(is_assoc($values))
							return new Error(8);
					}
				}
				else
					return new Eror(5);
			}
			

			$cpt = 0;
			foreach ($columns as $column) {
				$columnsValues[$column] = $values[$cpt];
				$cpt++;
			}

			// set de tous les types
			$types = $this->getTypes();
			foreach ($types as $key => $value) {
				if(!empty($columnsValues[$key])) {
					$data = $columnsValues[$key];
					$type = $value;
					if($type[0]=="type") {
						$typeClass = ucfirst($type[1])."Type";
						$result = $typeClass::update($this, $key, $data);
						if(is_array($result)) {
							$columnsValues[$key] = $result[0]; // Valeur de retour pour la requete
							$this->$key = $result[1]; // valeur de retour pour l'attribut ( Réinitialisation par ex. ) 
						}
						else
							$columnsValues[$key] = $result;
						if($columnsValues[$key]==-1)
							unset($columnsValues[$key]);
					}
				}
			}
			if(!empty($columnsValues)) {
				if(!Sql2::create()->update(strtolower($this->_class))->columnsValues($columnsValues)->where("id", Sql2::$OPE_EQUAL, $this->id)->execute())
					return false; 
			}
			
			// On met a jour les attributs
			$cpt = 0;
			foreach ($columns as $column) {
				$this->$column = $values[$cpt];
				$cpt++;
			}

			return $this;
		}
		else
			return new Error(1);
	}

	private function setCollection($attribut, $class, $params=null) {
		//Recherche de la table de liaison
		$table = $class."_".strtolower($this->_class);
   		if(!Sql2::table_exist($table))
   			$table = strtolower($this->_class)."_".$class;

   		// Recherche des IDs correspondant
		$requete = Sql2::create()
			->from($table)
			->where("id_".strtolower($this->_class), Sql2::$OPE_EQUAL, $this->id)
			->fetchArray();
		

		if(count($requete)==0) { // Si aucun liaison n'est trouvée
			$this->$attribut = false;
			return false;
		}
		else {
			// Formatage en tableau d'ID
			$ids = array();
			foreach ($requete as $key => $value) {
			 	$namekey = "id_".$class;
			 	$ids[] = $value[$namekey];
			}
			// Récupération de la collection
			$this->$attribut = App::getTable($class)->getCollection()->getById($ids);
			// Si il n'y a qu'un résultat
			if(get_class($this->$attribut) != "Collection") {
				$tmp = new Collection();
				$tmp->hydrate($this->$attribut);
				$this->$attribut = $tmp;
			}
			// 
			$this->$attribut->setObject($this);
			$this->$attribut->setTarget($class);
			return true;
		}
	}
}



?>