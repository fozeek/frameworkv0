<?php session_start();

	/*
		Webtuts Blog © 2012
		Created by :
			Richard Ettou
			Jonathan Bicheux
			Thibault Dulon
			Quentin Deneuve
	*/

	/* ERROR REPORTING */
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	/* 
		Appel du kernel
		kernels disponibles : 
			- site/kernel/kernel.php			Blog
			- portail/kernel/kernel.php 		Portail abonement newsletter

	*/
	require_once('site/kernel/kernel.php');

	/* 
		Appel du theme
	*/
	
?>