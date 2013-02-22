<?php define("_theme_path_", __themes_dir__ . "default/"); include("functions.php"); ?>
<?php /*if(!Kernel::get("user") && Kernel::get("action") == "connect" && Kernel::get("controler") == "home") { include(_theme_path_."pages/".Kernel::get("controler").'/'.Kernel::get("action").".php"); die(); } ?>
<?php if(!Kernel::get("user")) { header("Location:".Kernel::getUrl("home/connect")); die(); } */ ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("partials/meta.php");//Kernel::get("cache")->inc(_theme_path_."partials/meta.php"); ?>
		<title>Page d'accueil Webtuts</title>
		<script></script>
	</head>
	<body style="padding: 0px;margin: 0px;font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;background: #ECEFF6;">

		<div id="panel" style="display: none;z-index: 9999;position: absolute;top: 0px;left: 0px;width: 100%;background: rgba(255, 255, 255, 0.75);min-height: 100%;">
			<div style="border-radius: 5px;margin: 50px;box-shadow: 0px 3px 20px #ccc;">
				<div style="border-radius: 5px 5px 0px 0px;background: #323236;padding: 20px;color: white;padding-top: 15px;padding-bottom: 15px;">
					Title
				</div>
				<div style="border: 1px solid #E5E5E5;border-top: none;background: white;padding: 20px;border-radius: 0px 0px 5px 5px;">
				
					<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
						Champ 1
					</div>
					<div style="overflow: hidden;padding: 10px;">
						<input name="namefr" type="text"/>
					</div>
					<div style="clear: left;">
					</div>
					<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
						Champ 2
					</div>
					<div style="overflow: hidden;padding: 10px;">
						<input name="namefr" type="text"/>
					</div>
					<div style="clear: left;">
					</div>
					<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
						Text
					</div>
					<div style="overflow: hidden;padding: 10px;">
						<textarea name="descriptionfr"></textarea>
					</div>
					<div style="clear: left;">
					</div>


				</div>
			</div>
		</div>

		<div id="global">
			<div style="float: left;width: 130px;background: #ECEFF6;">
				<div style="">
					<div style="">
						<div style="text-align: center;padding: 20px;">
							<a href="<?php echo Kernel::getUrl("article/index"); ?>" style="display: block;padding: 5px;padding-top: 0px;font-size: 0.8em;font-weight: bold;">
								<img src="<?php echo img("content.png"); ?>" style="border: none;" alt="contents"/>
								<?php echo ucfirst(text("menu_contenu")); ?></span>
							</a>
						</div>

						<div style="text-align: center;padding: 20px;">
							<a href="<?php echo Kernel::getUrl("category/list"); ?>" style="display: block;padding: 5px;padding-top: 0px;font-size: 0.8em;font-weight: bold;">
								<img src="<?php echo img("taxonomy.png"); ?>" style="border: none;" alt="taxonomies"/>
								<?php echo ucfirst(text("menu_taxonomy")); ?></span>
							</a>
						</div>

						<div style="text-align: center;padding: 20px;">
							<a href="<?php echo Kernel::getUrl("user/list"); ?>" style="display: block;padding: 5px;padding-top: 0px;font-size: 0.8em;font-weight: bold;">
								<img src="<?php echo img("user.png"); ?>" style="border: none;" alt="users"/>
								<?php echo ucfirst(text("menu_users")); ?></span>
							</a>
						</div>

						<div style="text-align: center;padding: 20px;">
							<a href="<?php echo Kernel::getUrl("param/index"); ?>" style="display: block;padding: 5px;padding-top: 0px;font-size: 0.8em;font-weight: bold;">
								<img src="<?php echo img("param.png"); ?>" style="border: none;" alt="params"/>
								<?php echo ucfirst(text("menu_params")); ?></span>
							</a>
						</div>

					</div>
				</div>
			</div>
			
			<div style="overflow: hidden;">
		    		<?php include(_theme_path_."pages/".Kernel::get("controler").'/'.Kernel::get("action").".php"); ?>
		    	
					
		    		<?php /* ?>
					Temps de chargement de la page : <span style="font-weight: bold;"><?php echo round(microtime(TRUE)-time_start, 3); ?></span> sec<br />
					Nombre de requêtes : <span style="font-weight: bold;"><?php echo Sql2::$COUNT; ?></span> effectuée(s) : <br />
					<div style="border-left: 2px solid #E5E5E5;padding: 10px;margin-top: 5px;padding-top: 5px;padding-bottom: 5px;">
						<?php foreach (Sql2::$HISTO as $requete) { ?>
							<pre style="padding: 0px;margin: 0px;"><?php echo $requete; ?></pre>
						<?php } ?>
					</div>
					<?php */ ?>
				
			</div>
		</div>
	</body>
</html>