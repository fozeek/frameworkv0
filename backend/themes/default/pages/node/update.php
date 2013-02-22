<div style="padding :20px;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 20px;">
		<div style="font-size: 1.6em;float: left;">
			<span style="color: grey;"><?php echo ucfirst(text("node")); ?> :</span> 
			<?php echo minifyText(lang($node->get("name"))); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<a href="<?php echo createLink("/node/show/".$node->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/node/update/".$node->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
			<form method="post" action="/node/delete" style="display: inline-block; float: right;padding-right: 5px;padding-left: 5px;">
				<input type="hidden" name="id" value="<?php echo $node->get("id"); ?>"/>
				<input type="submit" value=<?php echo ucfirst(text("delete")); ?> style="margin-top: -10px;" />
			</form>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $node->get("id"); ?>"/>
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("name")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="namefr" type="text" value="<?php echo lang($node->get("name", "fr")); ?>"/>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("name")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="nameen" type="text" value="<?php echo lang($node->get("name", "en")); ?>"/>
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("description")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="descriptionfr"><?php echo lang($node->get("description", "fr")); ?></textarea>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("description")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="descriptionen"><?php echo lang($node->get("description", "en")); ?></textarea>
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