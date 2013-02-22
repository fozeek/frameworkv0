<?php partial("content_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("add_a_page")); ?>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<form action="" method="post">
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("title")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="title-fr" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("content")); ?> (fr)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="content-fr"></textarea>
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("title")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="title-en" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		<div style="clear: left;">
		</div>

		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("content")); ?> (en)
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<textarea name="content-en"></textarea>
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