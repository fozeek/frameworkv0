<?php partial("taxonomy_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<span style="color: grey;"><?php echo ucfirst(text("category")); ?> :</span> 
			<?php echo lang($category->get("name")); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<form method="post" action="<?php echo Kernel::getURL("category/delete"); ?>" style="margin-left: 20px;display: inline-block; float: right;padding-right: 5px;padding-left: 5px;">
				<input type="hidden" name="id" value="<?php echo $category->get("id"); ?>"/>
				<input type="submit" value=<?php echo ucfirst(text("delete")); ?> style="margin-top: -10px;" />
			</form>
			<a href="<?php echo createLink("/category/show/".$category->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/category/update/".$category->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<form action="<?php echo Kernel::getUrl("category/update"); ?>" method="post">
		<input type="hidden" name="id" value="<?php echo $category->get("id"); ?>" />
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("name")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="name-fr" type="text" value="<?php echo lang($category->get("name", "fr")); ?>"/>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("description")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="description-fr"><?php echo lang($category->get("description", "fr")); ?></textarea>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("name")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="name-en" type="text" value="<?php echo lang($category->get("name", "en")); ?>"/>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("description")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="description-en"><?php echo lang($category->get("description", "en")); ?></textarea>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input type="submit" value="<?php echo ucfirst(text("save")); ?>">
		</div>
		<div style="clear: left;">
		</div>
	</form>
</div>