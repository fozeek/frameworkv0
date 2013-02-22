<div style="padding :20px;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 20px;">
		<div style="font-size: 1.6em;float: left;">
			<span style="color: grey;"><?php echo ucfirst(text("page")); ?> :</span> 
			<?php echo minifyText(lang($page->get("title"))); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<form method="post" action="<?php echo Kernel::getUrl("page/delete"); ?>" style="margin-left: 20px;display: inline-block; float: right;padding-right: 5px;padding-left: 5px;">
				<input type="hidden" name="id" value="<?php echo $page->get("id"); ?>"/>
				<input type="submit" value=<?php echo ucfirst(text("delete")); ?> style="margin-top: -10px;" />
			</form>	
			<?php foreach(Kernel::get("langs") as $key => $langKernel) { ?>
				<a <?php if($lang!=$langKernel) { ?>href="<?php echo createLink("/page/show/".$page->get("id")."/".$langKernel); ?>"<?php } ?> style="float: right;"><?php echo text($langKernel); ?></a> 
				<?php if($key!=count(Kernel::get("langs"))-1) { ?>
				<span style="float: right;">&nbsp;&nbsp;</span> 
				<?php } ?>
			<?php } ?>
			<a href="<?php echo createLink("/page/show/".$page->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/page/update/".$page->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("title")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo lang($page->get("title", $lang)); ?>
	</div>
	<div style="clear: left;">
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("content")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo lang($page->get("text", $lang)); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("pseudo")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo $page->get("author")->get("pseudo"); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("date")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo lang($page->get("date")); ?>
	</div>
	<div style="clear: left;">
	</div>
</div>