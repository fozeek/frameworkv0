<?php

	 define("_theme_path_", __themes_dir__ . "default/");
	 include(__library_dir__ . "lang/" . Kernel::get("lang") . ".php");
 	 include("functions.php");

?>
<html>
	<head>
	    <?php
		include("partials/meta.php");
	    //Kernel::get("cache")->inc(_theme_path_."partials/meta.php");
		$end_title = "";
		if(Kernel::get("action") == "category" ||
		   Kernel::get("action") == "article" ||
		   Kernel::get("action") == "actualite" ||
		   Kernel::get("action") == "tag" ||
		   Kernel::get("action") == "profil"){
		   $newUrl = explode("/", Kernel::$URL);
		   $end_title = str_replace("-"," ",end($newUrl));
		   
		}
	    ?>
	    <link type="text/css" rel="stylesheet" href="<?php echo _host_absolute_ . _theme_path_ ?>css/<?php echo Kernel::get("controler"); ?>.css" />
	    
	    <title><?php echo get_title_from_url(Kernel::get("controler"),Kernel::get("action")) . " " . $end_title; ?></title>
	   </head>
	<body>
		<div id="global">
			<!-- Header -->
			<?php include("partials/header.php"); ?>
			
			<!-- Content -->
			<div id="content">
			    <?php include(_theme_path_."pages/".Kernel::get("controler").'/'.Kernel::get("action").".php"); ?>
			</div>
			
			<!-- Footer -->
			<?php include("partials/footer.php"); ?>
		</div>
	</body>
</html>