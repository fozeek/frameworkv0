<?php


	/*
		Fichier de configuration : 
		Contient toutes les informations necessaires à fournir par l'administrateur et à écrire en dur.
	*/

	/* 
		Définition de l'application
	*/
	//define("__app__", "frontend");
	define("__app__", "backend");


	/* 
		DEBUG MODE 
		Commentaires :
			- Permet de passer le kernel en mode débug ou non : affichage de page d'erreurs.
		Possibilités :
			true		active le mode débug
			false		désative le mode débug
	*/
	$_KERNEL_DEBUG_ = true;

	/*
		Langues
	*/
	$_LANG_DEFAULT_ = "fr";
	$_LANG_ACCEPTED_ = array("fr", "en");

	/* 
		SQL parameters
	*/
	/* Host name */
	define("__SQL_hostname__", "localhost");
	/* User */
	define("__SQL_user__", "root");
	/* Password */
	define("__SQL_password__", "root");
	/* Prefix tables */
	define("__SQL_prefix__", "");
	/* Database */
	define("__SQL_db__", "webtutsv2");
	
?>