<div style="padding :20px;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("backend")); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<div style="height: 20px;">
	</div>

	<div style="float: right;width: 200px;margin-left: 20px;">
		<div style="border-bottom: 1px solid #E5E5E5;font-size: 0.8em;font-weight: bold;padding-bottom: 3px;">
			Quick links
		</div>
		<div style="padding-top: 5px;padding-bottom: 5px;font-size: 0.8em;padding-left: 3px;">
			&#149; <a href="http://www.grafikart.fr/">GrafikArt</a><br />
		</div>
		<br />
		<div style="border-bottom: 1px solid #E5E5E5;font-size: 0.8em;font-weight: bold;padding-bottom: 3px;">
			Documents
		</div>
		<div style="padding-top: 5px;padding-bottom: 5px;font-size: 0.8em;padding-left: 3px;">
			&#149; <a href="/documents/webtuts.sql">BDD</a><br />
			&#149; <a href="/documents/CDCF projet annuel.docx">CDC</a><br />
		</div>
	</div>
	<div style="overflow: hidden;">
		<div style="border-bottom: 1px solid #E5E5E5;font-size: 0.8em;font-weight: bold;padding-bottom: 3px;">
			Notifications
		</div>
		<?php foreach ($notifications as $notification) { ?>
		<div style="border-bottom: 1px solid #E5E5E5;padding: 15px;">
			<div style="float: right;font-size: 0.8em;color: grey;">
				<?php echo printDate($notification->get("date")); ?>
			</div>
			<?php echo lang($notification->get("title")); ?> <span style="color: grey;">by</span> <a href="<?php echo createLink("user/".$notification->get("author")->get("id")); ?>"><?php echo $notification->get("author")->get("pseudo"); ?></a>
			<div style="border-left: 2px solid #E5E5E5;padding: 10px;font-size: 0.8em;margin-top: 5px;">
				<?php echo nl2br(lang($notification->get("text"))); ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<div style="clear: both;">
	</div>
</div>

<?php

echo "<pre>";
/*

foreach(Kernel::$PDO->query("SELECT * FROM category WHERE id=1") as $key => $cats) {
	print_r($cats);
}*/
/*
print_r(Kernel::$PDO->query("SELECT * FROM category WHERE id=1")->fetchObject("Article"));
echo "</pre>";

	echo "<pre>";*/
	/*if(App::getClass("category")->hydrate(array("name" => 35, "description" => 36, "image" => 7))->save())
		echo "did !";
	else
		echo "fail";*/
/*
	print_r(App::getClass("category")->hydrate(array(
		"name" => array(
			"fr" => "TitleFr",
			"en" => "TitleEn"
		), 
		"description" => array(
			"fr" => "DescriptionFr"
		),
		"image" => 7,
		"deleted" => 0
	)));
	echo "<pre>";
	print_r(App::getClassArray("article", array(
		"limit" => 5,
		"where" => array(
				"have" => "category"
		)
	)));
	echo "</pre>";

	print_r(App::getClassArray("category", array(
			"limit" => 5,
			"where" => array(
				"where" => array(
					"nothave" => "category"
				),
				"andwhere" => array(
					"where" => "date >= 10/02/21",
					"andwhere" => "date <= 13/03/21"
				)
			)
		)));*/
	//print_r(App::getTable("article")->getBySanitizeTitle("liste-des-fonctionalites-de-la-class-kernel"));
	/*
	$cat = App::getClass("category", 1);
	$cat->get("name");
	$cat->set(array("image" => 1, "deleted" => "false", "name" => array("fr" => "Intégration", "en" => "Integration")));
	echo "<br />";
	print_r($cat->get("name"));
	*/

	
?></pre>