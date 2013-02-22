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
			<?php foreach(Kernel::get("langs") as $key => $langKernel) { ?>
				<a <?php if($lang!=$langKernel) { ?>href="<?php echo createLink("/category/show/".$category->get("id")."/".$langKernel); ?>"<?php } ?> style="float: right;"><?php echo text($langKernel); ?></a> 
				<?php if($key!=count(Kernel::get("langs"))-1) { ?>
				<span style="float: right;">&nbsp;&nbsp;</span> 
				<?php } ?>
			<?php } ?>
			<a href="<?php echo createLink("/category/show/".$category->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/category/update/".$category->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("name")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo lang($category->get("name", $lang)); ?>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("description")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo lang($category->get("description", $lang)); ?>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("image")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php if($category->get("image")) { ?>
			<a href="<?php echo createLink("/image/show/".$category->get("image")->get("id")); ?>"><?php echo $category->get("image")->get("name").".".$category->get("image")->get("type"); ?></a>
		<?php } else { ?>
			pas d'image
		<?php } ?>
	</div>
	<div style="clear: left;">
	</div>
</div>