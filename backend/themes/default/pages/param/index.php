<?php partial("param_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("params")); ?>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<?php foreach(Kernel::get("params") as $key => $value) : if(is_string($key)) :?>
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text($key)); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo $value; ?>
	</div>
	<div style="clear: left;">
	</div>
	<?php endif; endforeach; ?>

</div>