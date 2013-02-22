<?php partial("taxonomy_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("tags")); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<?php foreach(Kernel::get("langs") as $key => $langKernel) { ?>
				<a <?php if($lang!=$langKernel) { ?>href="<?php echo createLink("/tag/list/".$langKernel); ?>"<?php } ?> style="float: right;"><?php echo text($langKernel); ?></a> 
				<?php if($key!=count(Kernel::get("langs"))-1) { ?>
				<span style="float: right;">&nbsp;&nbsp;</span> 
				<?php } ?>
			<?php } ?>
			<a href="<?php echo createLink("/tag/add"); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("add_a_tag")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<?php foreach ($tags as $tag) : ?>
	<a href="<?php echo createLink("/tag/show/".$tag->get("id")); ?>">
	<div class="itemlist" style="border-bottom: 1px solid #E5E5E5;">	
		<div style="float: left;width: 200px;">
			<?php echo lang($tag->get("name", $lang)); ?>
		</div>
		<div style="overflow: hidden;padding-top: 1px;padding-left: 10px;">
			<span style="font-size: 0.8em;color: grey;"><?php echo lang($tag->get("description", $lang)); ?></span>
		</div>
		<div style="clear: both;">
		</div>
	</div>
	</a>
	<?php endforeach; ?>

</div>