<?php 

$GLOBALS["SQL_existing_table"] = array();

/*
	Class User
	Description : 
		-
		-
*/


class Sql {

	public static $_SELECT = "_SELECT";
	public static $_INSERT = "_INSERT";
	public static $_UPDATE = "_UPDATE";


	public static $DEFAULT = "=";
	public static $EQUAL = "=";
	public static $NOT_EQUAL = "!=";
	public static $UPPER_EQUAL = ">=";
	public static $LOWER_EQUAL = "<=";
	public static $UPPER = ">";
	public static $LOWER = "<";
	
	var $type;
	var $action;
	var $requete = "";
	var $class;
	var $action_before = false;
	var $columns = array();
	var $values = array();

	public function __construct() {

	}

	static public function create() {
		return new Sql();
	}

	public function select($select = null) {
		$this->type = Sql::$_SELECT;
		$this->action_before = true;
		$this->requete .= "SELECT ";
		$elements = "";
		if($select != null) {
			for($i=0;$i<sizeof($select);$i++) {
				$elements .= $select[$i];
				if($i<(sizeof($select)-1)) $elements .= ", ";
			}
		}
		else
			$elements = "*";
		$this->requete .= $elements." ";
		return $this;
	}

	public function insert($into) {
		$this->type = Sql::$_INSERT;
		$this->class = ucfirst($into);
		$this->requete .= "INSERT INTO ".__SQL_prefix__.$into." ";
		return $this;
	}

	public function update($table) {
		$this->action = true;
		$this->type = Sql::$_UPDATE;
		$this->requete .= "UPDATE ".__SQL_prefix__.$table." ";
		return $this;
	}

	public function columns($columns) {
		$this->columns = $columns;
		return $this;
	}

	public function values($values) {
		$this->values = $values;
		return $this;
	}

	public function value($column, $value) {
		$this->columns[] = $column;
		$this->values[] = $value;
		return $this;
	}

	public function columnsValues($columns, $values = null) {
		$columnsValues = array();
		if($values==null) {
			if(!is_object($columns))
				$columnsValues = $columns;
			else {
				foreach ($columns as $attribut => $value)
					$columnsValues[$attribut] = $value;
			}
	    }
	    else {
	    	if(sizeof($columns) == sizeof($values) && sizeof($values)>0) {
	    		for($cpt=0;$cpt<sizeof($columns);$cpt++)
	    			$columnsValues[$columns[$cpt]] = $values[$cpt];
	    	}
	    	else
	    		return new Error(1);
	    }

		$columns = array();
		$values = array();
		foreach($columnsValues as $column=>$value) { 
    		$columns[] = $column;
    		$values[] = $value;
    	} 
    	$this->columns = $columns;
    	$this->values = $values;
    	return $this;
	}


	public function from($from, $fromMore=null) {
		$this->type = Sql::$_SELECT;
		if(!$this->action_before)
			$this->requete .= "SELECT * ";
		$class = $from;
		if(strpos($class, " ")) {
			$tmp = explode(" ", $class);
			$class = $tmp[0];
		}
		$this->class = ucfirst($class);
		$this->requete .= "FROM ".__SQL_prefix__.$from." ";
		if($fromMore!=null)
			$this->requete .= ", ".$fromMore." ";
		return $this;
	}

	public static function term() {
		$return = "";

		return $return;
	}

	public function bracket($bool) {
		if($bool)
			$this->action = "bracket";
		else
			$this->requete .= ") ";
		return $this;
	}
	private function bracketRecorder() {
		$return = "";
		if($this->action=="bracket") {
			$return .= "( ";
			$this->action = "";
		}
		return $return;
	}

	public static function n($class) {
		return new $class();
	}

	public function where($attribut, $condition=null, $param=null) {
		if($this->type == Sql::$_UPDATE && $this->action)
			$this->insertInsertRequete();
		$bracket = $this->bracketRecorder();
		if($condition!=null)	
			$this->requete .= "WHERE ".$bracket." ".$attribut." ".$condition." ".$param." ";
		else {
			if(!is_object($attribut))
				$this->requete .= "WHERE ".$attribut." ";
			else
				$this->requete .= "WHERE ( ".$attribut->getString()." ) ";
		}
			
		return $this;
	}

	public function andWhere($attribut, $condition=null, $param=null) {
		$bracket = $this->bracketRecorder();
		if($condition!=null)	
			$this->requete .= "AND ".$bracket." ".$attribut." ".$condition." ".$param." ";
		else {
			if(!is_object($attribut))
				$this->requete .= "AND ".$attribut." ";
			else
				$this->requete .= "AND ( ".$attribut->getString()." ) ";
		}
		return $this;
	}
	public function orWhere($attribut, $condition=null, $param=null) {
		$bracket = $this->bracketRecorder();
		if($condition!=null)	
			$this->requete .= "OR ".$bracket." ".$attribut." ".$condition." ".$param." ";
		else {
			if(!is_object($attribut))
				$this->requete .= "OR ".$attribut." ";
			else
				$this->requete .= "OR ( ".$attribut->getString()." ) ";
		}
		return $this;
	}
	public function orderBy($column, $way) {
		$this->requete .= "ORDER BY ".$column." ".$way." ";
		return $this;
	}
	public function limit($start=0, $end=null) {
		$this->requete .= "LIMIT ".$start;
		if(!$end==null)
			$this->requete .= ", ".$end;
		$this->requete .= " ";
		return $this;
	}

	
	public function fetchClass() {
		if(!class_exists($this->class))
			$class = "Std";
		else $class = $this->class;
		$return = mysql_fetch_object(mysql_query($this->requete), $class);
		$return->setNameClass($this->class);
		return $return;
	}
	public function fetchStdClass() {
		return mysql_fetch_object(mysql_query($this->requete));
	}


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
	private function insertCreateRequete() {
		if(count($this->columns)>0) {
			$this->requete .= "(";
			$cpt = 0;
			foreach($this->columns as $value) {
				if($cpt!=0) $this->requete .= ", ";
	    		$escape = "";
	    		$this->requete .= $escape.$value.$escape;
	    		$cpt++;
	    	}
	    	$this->requete .= ") ";
		}
	   	$this->requete .= "VALUES (";
    	$cpt = 0;
    	foreach($this->values as $value) {
			if($cpt!=0) $this->requete .= ", ";
    		if(is_string($value)) $escape = "'";
    		else $escape = "";
    		$this->requete .= $escape.$value.$escape;
    		$cpt++;
    	}
    	$this->requete .= ")";
	}
	private function insertInsertRequete() {
		$this->requete .= "SET ";
		$cpt = 0;
    	foreach($this->values as $value) {
			if($cpt!=0) $this->requete .= ", ";
    		if(is_string($value)) $escape = "'";
    		else $escape = "";
    		$this->requete .= $this->columns[$cpt]."=".$escape.$value.$escape;
    		$cpt++;
    	}
    	$this->requete .= " ";
    	$this->action = false;
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

	public function getRequete() {
		return $this->requete;
	}
	public function getClassAttribut() {
		return $this->class;
	}

	public static function table_exist($table){
		return SQL_table_exist($table);
	}

}

function SQL_table_exist($table) {
	if(count($GLOBALS["SQL_existing_table"])<=0) {
		$db = __SQL_db__;
	    $query = "SHOW TABLES FROM $db";
	    $runQuery = mysql_query($query);
	    //On crée un nouveau tableau avec toutes les tables
	    while($row = mysql_fetch_row($runQuery)){
	        $GLOBALS["SQL_existing_table"][] = $row[0];
	    }
	}
    //On vérifie si $table est dans le tableau tables
    if(in_array($table, $GLOBALS["SQL_existing_table"]))
        return TRUE;
    else
    	return false;
}


class bracket {

	var $string;

	public function __construct() {
		$this->string ="";
		return $this;
	}

	public function where($attribut, $condition=null, $param=null) {
		if($condition!=null)	
			$this->string .= $attribut." ".$condition." ".$param." ";
		else
			$this->string .= $attribut." ";
		return $this;
	}

	public function andWhere($attribut, $condition=null, $param=null) {
		if($condition!=null)	
			$this->string .= "AND ".$attribut." ".$condition." ".$param." ";
		else
			$this->string .= "AND ".$attribut." ";
		return $this;
	}
	public function orWhere($attribut, $condition=null, $param=null) {
		if($condition!=null)	
			$this->string .= "OR ".$attribut." ".$condition." ".$param." ";
		else
			$this->string .= "OR ".$attribut." ";
		return $this;
	}

	public function getString() {
		return $this->string;
	}

}

?>