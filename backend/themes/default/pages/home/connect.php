<!DOCTYPE html>
<html>
	<head>
		<?php include("site/backend/themes/default/partials/meta.php");//Kernel::get("cache")->inc(_theme_path_."partials/meta.php"); ?>
		<title>Page d'accueil Webtuts</title>
		<script></script>
	</head>
	<body style="margin: 50px;">
		<div style="border: 1px solid #ccc;width: 400px;margin: auto;border-radius: 5px;background: #E5E5E5;font-family: Courier;">
			<div style="background: #E5E5E5;padding: 20px;border-top: 1px solid white;border-radius: 5px;">
				<form method="post" action="<?php echo Kernel::getUrl("home/connect"); ?>">
					<div style="color: #bbb;text-shadow: 0px 1px 0px white;margin-left: 5px;font-size: 2em;">Administration</div>
					<div style="color: grey;border-bottom: 1px solid white;border-radius: 5px;margin-top: 20px;padding: 0px;">
						<input placeholder="Login" name="pseudo" type="text" style="color: grey;font-family: Courier;outline: none;width: 348px;border: 1px solid #ccc;background: white;margin: 0px;padding: 5px;font-size: 20px;border-radius: 5px;" />
					</div>
					<div style="color: grey;border-bottom: 1px solid white;border-radius: 5px;margin-top: 20px;padding: 0px;">
						<input placeholder="Password" name="password" type="password" style="color: grey;font-family: Courier;outline: none;width: 348px;border: 1px solid #ccc;background: white;margin: 0px;padding: 5px;font-size: 20px;border-radius: 5px;" />
					</div>
					<div style="margin-top: 20px;float: right;">
						<input type="submit" value="Se connecter">
					</div>
					<div style="color: red;margin-top: 20px;padding: 5px;">
						<?php print_r((isset($error)) ? $error: "" ) ?>
					</div>
					<div style="clear: right;">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>