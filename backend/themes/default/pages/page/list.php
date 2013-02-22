<?php partial("content_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("pages")); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<?php foreach(Kernel::get("langs") as $key => $langKernel) { ?>
				<a <?php if($lang!=$langKernel) { ?>href="<?php echo createLink("/page/list/".$langKernel); ?>"<?php } ?> style="float: right;"><?php echo text($langKernel); ?></a> 
				<?php if($key!=count(Kernel::get("langs"))-1) { ?>
				<span style="float: right;">&nbsp;&nbsp;</span> 
				<?php } ?>
			<?php } ?>
			<a href="<?php echo createLink("/page/add"); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("add_a_page")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<?php foreach ($pages as $page) { ?>
	<a class="itemlist" href="<?php echo createLink("/page/show/".$page->get("id")); ?>">
		<div class="titleitem" style="float: left;width: 400px;">
			<?php echo lang($page->get("title", $lang)); ?>
		</div>
		<div class="descriptionitem" style="position: relative;overflow: hidden;padding-top: 1px;padding-left: 10px;">
			<span style="font-size: 0.8em;color: grey;"><?php echo lang($page->get("text", $lang)); ?></span>
			<div class="borderitem" style="display: none;position: absolute;bottom: 0px;left: 0px;width: 100%;height: 2px;background: #E5E5E5;opacity: 0.7;">
			</div>
		</div>
		<div style="clear: both;">
		</div>
	</a>
	<?php } ?>

</div>