<?php partial("user_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 10px;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("add_a_user")); ?>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<form action="" method="post">
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("firstname")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="firstname" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("name")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="name" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("civility")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="gender" type="radio" value="man"/> <?php echo ucfirst(text("mr")); ?>
			<input name="gender" type="radio" value="woman"/> <?php echo ucfirst(text("miss")); ?>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("pseudo")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="pseudo" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("password")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="pwd" type="text"/>
		</div>
		<div style="clear: left;">
		</div>
		
		<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
			<?php echo ucfirst(text("mail")); ?>
		</div>
		<div style="overflow: hidden;padding: 10px;">
			<input name="mail" type="text"/>
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