<?php
/*
	Class App
	Description : 
		Classe permettant d'accéder aux objets ou table de la base de données
*/
class App {

	/*
		Retourne la classe de l'objet désiré.
		Si elle n'existe pas, la classe générique est retournée.
	*/
	static public function getClass($class) {
		if(class_exists($class))
			return new $class($class);
		else
			return new Std($class);
	}

	/*
		Retourne la classe de la table désirée.
		Si elle n'existe pas, la classe générique est retournée.
	*/
	static public function getTable($table) {
		$tableName = ucfirst($table)."Table";
		if(!class_exists($tableName))
			return new StdTable($table);
		else 
			return new $tableName($table);
	}
}