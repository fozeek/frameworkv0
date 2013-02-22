<?php 

$GLOBALS["SQL_existing_table"] = array();

/*
	Class User
	Description : 
		-
		-
*/


class Sql3 {

	public static $TYPE_SELECT = "_SELECT";
	public static $TYPE_INSERT = "_INSERT";
	public static $TYPE_UPDATE = "_UPDATE";

	public static $TYPE_NO_QUOTE = false;

	public static $OPE_DEFAULT = "=";
	public static $OPE_EQUAL = "=";
	public static $OPE_NOT_EQUAL = "!=";
	public static $OPE_UPPER_EQUAL = ">=";
	public static $OPE_LOWER_EQUAL = "<=";
	public static $OPE_UPPER = ">";
	public static $OPE_LOWER = "<";
	public static $OPE_IN = "IN";
	public static $OPE_NOT_IN = "NOT IN";
	
	private $OPE_LOGIC_TAB = array("where" => "", "andwhere" => "AND", "orwhere" => "OR");

	private $class;
	private $type;
	private $select;
	private $from;
	private $where;
	private $columns = array();
	private $values = array();
	private $orderby;
	private $limit;

	public function __construct() {
	}

	static public function create() {
		return new Sql2();
	}

	public function select($select = null) {
		if(is_array($select)) {
			$this->select = $select;
		}
		else {
			for($cpt=0;$cpt<func_num_args();$cpt++)
				$this->select[] = func_get_arg($cpt);
		}
		return $this;
	}

	public function insert($into) {
		$this->type = Sql2::$TYPE_INSERT;
		$this->class = $into;
		return $this;
	}

	public function update($table) {
		$this->type = Sql2::$TYPE_UPDATE;
		$this->from = $table;
		return $this;
	}

	public function columns($columns = null) {
		if(is_array($columns)) {
			$this->columns = $columns;
		}
		else {
			for($cpt=0;$cpt<func_num_args();$cpt++)
				$this->columns[] = func_get_arg($cpt);
		}
		return $this;
	}

	public function values($values = null) {
		if(is_array($values)) {
			$this->values = $values;
		}
		else {
			for($cpt=0;$cpt<func_num_args();$cpt++)
				$this->values[] = func_get_arg($cpt);
		}
		return $this;
	}

	/*
		Peut prendre 3 types de syntaxe en parametres

		columnsValues("collonne", "value"); // valeurs String
		columnsValues(array("collonne1", "collonne2"), array("value1", "value2")); // Deux tableaux
		columnsValues(array("collonne1" => "value1", "collonne2" => "value2")); // Tableau associatif

	*/
	public function columnsValues($columns, $values=null) {
		if(!empty($columns)) {
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
					return new Error(5);
			}

			$this->columns = array_merge($this->columns, $columns);
			$this->values = array_merge($this->values, $values);
			return $this;
		}
		else
			return new Error(12);
	}

	public function from($from) {
		$this->type = Sql2::$TYPE_SELECT;
		if(is_array($from)) {
			foreach ($from as $value) {
				$this->from[] = $value;
			}
		}
		else {
			for($cpt=0;$cpt<func_num_args();$cpt++)
				$this->from[] = func_get_arg($cpt);
		}
		return $this;
	}

	public static function n($class) {
		return new $class();
	}

	public function where($attribut, $condition=null, $param=null, $typeVar=true) {
		if(is_object($attribut))
			$this->where[] = $attribut;
		else
			$this->where[] = array("where", $attribut, $condition, $param, $typeVar);
		return $this;
	}

	public function andWhere($attribut, $condition=null, $param=null, $typeVar=true) {
		if(is_object($attribut))
			$this->where[] = $attribut;
		else
			$this->where[] = array("andwhere", $attribut, $condition, $param, $typeVar);
		return $this;
	}
	public function orWhere($attribut, $condition=null, $param=null, $typeVar=true) {
		if(is_object($attribut))
			$this->where[] = $attribut;
		else
			$this->where[] = array("orwhere", $attribut, $condition, $param, $typeVar);
		return $this;
	}
	public function orderBy($column, $way=null) {
		$this->orderby = array($column, $way);
		return $this;
	}
	public function limit($start=0, $end=null) {
		$this->limit = array($start, $end);
		return $this;
	}

	private function getRequete() {
		$requete = "";
		if($this->type == Sql2::$TYPE_SELECT)
			$requete = $this->getselectRequete();
		elseif($this->type == Sql2::$TYPE_INSERT)
			$requete = $this->getInsertRequete();
		elseif($this->type == Sql2::$TYPE_UPDATE)
			$requete = $this->getUpdateRequete();
		else
			return new Error(1);
		return $requete;
	}

	private function getSelectRequete() {
		$this->class = ucfirst($this->from[0]);
		$requete = "SELECT ";
		// SELECT
		if(empty($this->select))
			$requete .= "*";
		elseif(is_array($this->select)) {
			$cpt = 0;
			foreach($this->select as $value) {
				if($cpt!=0) $requete .= ", ";
				$requete .= $value;
	    		$cpt++;
	    	}
		}
		else {
			$requete .= $this->select;
		}
		// FROM
		$requete .= " FROM ";
		$cpt = 0;
		foreach($this->from as $value) {
			if($cpt!=0) $requete .= " ".chr($cpt+64).", ";
			$requete .= $value;
    		$cpt++;
    	}
    	$requete .= " ".chr($cpt+64)."";

		// WHERE
		$requete .= $this->getWhereString();

		// ORDER BY
		if(!empty($this->orderby)) {
			if(is_string($this->orderby[0])) $cote='\''; else $cote='';
			$requete .= " ORDER BY ".$cote.$this->orderby[0].$cote." ".$this->orderby[1];
		}
		// LIMIT
		if(!empty($this->limit)) {
			$requete .= " LIMIT ".$this->limit[0];
			if($this->limit[1]!=null)
				$requete .= ", ".$this->limit[1];
		}

		return $requete;
	}

	private function getInsertRequete() {
		$requete = "INSERT INTO ";
		$requete .= mb_strtolower($this->class)." (";
		$cpt = 0;
		foreach ($this->columns as $key => $value) {
			if($cpt!=0) $requete .= ", ";
			$requete .= $value;
			$cpt++;
		}
		$requete .= ") VALUES (";
		$cpt = 0;
		foreach ($this->values as $key => $value) {
			if(is_string($value)) $cote='\''; else $cote='';
			if(empty($value) && $value != "0") { $value = 'NULL'; $cote=''; }
			if($cpt!=0) $requete .= ", ";
			$requete .= $cote.$value.$cote;
			$cpt++;
		}
		$requete .= ")";
		return $requete; 
	}

	private function getUpdateRequete() {
		if(count($this->columns)==count($this->values) && count($this->values)>0) {
			$requete = "UPDATE ".mb_strtolower($this->from)." SET ";
			$cpt = 0;
			foreach ($this->columns as $key => $value) {
				if(is_string($this->values[$cpt])) $cote='\''; else $cote='';
				if($cpt!=0) $requete .= ", ";
				$requete .= $value." = ".$cote.$this->values[$cpt].$cote;
				$requete .= "";
				$cpt++;
			}
			if(!empty($this->where)) {
				$requete .= " WHERE ";
				$requete .= $this->getWhereString();
			}
			return $requete; 
		}
		else
			return new Error(4);
	}
	
	public function fetchClass() {
		if($this->type==Sql2::$TYPE_SELECT)	{
			$requete = $this->getRequete();
			if(!class_exists($this->class))
				$class = "Std";
			else $class = $this->class;
			$return = mysql_fetch_object(mysql_query($requete), $class);
			if(method_exists($return,'setNameClass')) {
				$return->setNameClass($this->class);
				$return->setTypage(Sql2::create()->from("ORM_columns_types")->where("name_table", Sql2::$OPE_EQUAL, mb_strtolower($this->class))->fetchArray());
			}
			return $return;
		}
		else
			return new Error(2);
	}

	public function fetchArray() {
		$requete = $this->getRequete();
		$return = array();
		$resultat = mysql_query($requete);
		while($ligne = mysql_fetch_array($resultat)) 
			$return[] = $ligne;
		return $return;
	}

	public function fetchClassArray() {
		if($this->type==Sql2::$TYPE_SELECT)	{
			$requete = $this->getRequete();
			$class = $this->class;
			$collection = new Collection();
			$sql = mysql_query($requete);
			while($result = mysql_fetch_assoc($sql)) {
				$types = Sql2::create()->from("ORM_columns_types")->where("name_table", Sql2::$OPE_EQUAL, mb_strtolower($this->class))->fetchArray();
				$collection->hydrate(OrmStdAbstract::n($class)->hydrate($result, $types));
			}
			return $collection;
		}
		else
			return new Error(2);
	}

	public function execute() {
		if($this->type == Sql2::$TYPE_INSERT || $this->type == Sql2::$TYPE_UPDATE){
			$requete = $this->getRequete();
			if(mysql_query($requete)) {
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}

	public function fetch($rang=0) {
		if($this->type == Sql::$_SELECT) {
			$requete = $this->getRequete();
			if ($resultat = @mysql_query($requete)) {
				if(@mysql_num_rows($resultat)>0)
					return mysql_result($resultat, $rang);
				else
					return false;
			}
			else
				return false;
		}
		else
			return new Error(3);
	}

	private function getWhereString() {
		$requete = "";
		if(!empty($this->where)) {
			$requete .= " WHERE ";
			foreach ($this->where as $key => $value) {
				if(!is_object($value)) {
					if(is_string($value[3]) && $value[4]) $cote2='\''; else $cote2='';
					$requete .= " ".$this->OPE_LOGIC_TAB[$value[0]]." ".$value[1]." ".$value[2]." ".$cote2.$value[3].$cote2." ";
				}
				else {
					$requete .= $this->getWhereStringRecursive($value);
				}
			}
		}
		return $requete;
	}

	private function getWhereStringRecursive($object) {
		$requete = "(";
		foreach ($object->where as $key2 => $value2) {
			if(!is_object($value2)) {
				if(is_string($value2[3]) && $value2[4]) $cote2='\''; else $cote2='';
				$requete .= " ".$this->OPE_LOGIC_TAB[$value2[0]]." ".$value2[1]." ".$value2[2]." ".$cote2.$value2[3].$cote2." ";
			}
			else
				$requete .= $this->getWhereStringRecursive($value2);
		}
		$requete .= ")";
		return $requete;
	}

	/*

	public function fetchOne($rang = 0) {
		return mysql_result(mysql_query($this->requete), $rang);
	}
	public function fetch() {
		return mysql_query($this->requete);
	}
	public function fetchArray() {
		$class = ucfirst($this->class);
		$collection = new Collection();
		$sql = mysql_query($this->requete);
		while($result = mysql_fetch_assoc($sql))
			$collection->hydrate(Std::n($class)->hydrate($result));
		return $collection;
	}
	public function execute() {
		if($this->type == Sql::$_INSERT)
			$this->insertCreateRequete();
		else if($this->type == Sql::$_UPDATE && $this->action)
			$this->insertInsertRequete();
		mysql_query($this->requete);
		return mysql_insert_id();
	}
	public function executeClass() {
		mysql_query($this->requete);
		return Sql::create()->from(mb_strtolower($this->class))->where("id=".mysql_insert_id())->fetchClass();
	}

	
	public function getClassAttribut() {
		return $this->class;
	}
	
	*/

	public function showRequete() {
		return $this->getRequete();
	}
	
	public static function table_exist($table){
		return SQL2_table_exist($table);
	}

	

}

class SqlTerms {

	static public function where($attribut, $condition=null, $param=null, $typeVar=true) {
		$object = new SqlTerms();
		if(is_object($attribut))
			$object->where[] = $attribut;
		elseif($condition == null)
			$this->where[] = $attribut;
		else
			$object->where[] = array("where", $attribut, $condition, $param, $typeVar);
		return $object;
	}

	public function andWhere($attribut, $condition=null, $param=null, $typeVar=true) {
		if(is_object($attribut))
			$this->where[] = $attribut;
		elseif($condition == null)
			$this->where[] = $attribut;
		else
			$this->where[] = array("andwhere", $attribut, $condition, $param, $typeVar);
		return $this;
	}
	public function orWhere($attribut, $condition=null, $param=null, $typeVar=true) {
		if(is_object($attribut))
			$this->where[] = $attribut;
		elseif($condition == null)
			$this->where[] = $attribut;
		else
			$this->where[] = array("orwhere", $attribut, $condition, $param, $typeVar);
		return $this;
	}
}

function SQL2_table_exist($table) {
	if(count($GLOBALS["SQL_existing_table"])<=0) {
		$db = __SQL_db__;
	    //On crée un nouveau tableau avec toutes les tables
	    foreach(Kernel::$PDO->query("SHOW TABLES FROM $db") as $row){
	        $GLOBALS["SQL_existing_table"][] = $row[0];
	    }
	}
    //On vérifie si $table est dans le tableau tables
    if(in_array($table, $GLOBALS["SQL_existing_table"]))
        return TRUE;
    else
    	return false;
}


?>