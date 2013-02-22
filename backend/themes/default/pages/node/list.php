<div style="padding :20px;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("nodes")); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<a href="<?php echo createLink("/node/add"); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("add_a_node")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<?php foreach ($nodes as $node) : ?>
	<a href="<?php echo createLink("/node/show/".$node->get("id")); ?>">
	<div class="itemlist">	
		<div style="float: left;width: 200px;">
			<?php echo lang($node->get("name")); ?>
		</div>
		<div style="overflow: hidden;padding-top: 1px;padding-left: 10px;">
			<span style="font-size: 0.8em;color: grey;"><?php echo lang($node->get("description")); ?></span>
		</div>
		<div style="clear: both;">
		</div>
	</div>
	</a>
	<?php endforeach; ?>

</div>