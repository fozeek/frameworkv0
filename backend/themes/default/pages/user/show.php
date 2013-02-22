
<?php partial("user_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;margin-bottom: 20px;"><!-- background: #323236; -->
		<div style="font-size: 1.6em;float: left;">
			<span style="color: grey;">User :</span> 
			<?php echo minifyText(lang($user->get("pseudo"))); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<a href="<?php echo createLink("/user/show/".$user->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("description")); ?></a>
			<a href="<?php echo createLink("/user/update/".$user->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("update")); ?></a>
			<a href="<?php echo createLink("/user/delete/".$user->get("id")); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("delete")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("firstname")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo ucfirst($user->get("name")); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("name")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo ucfirst($user->get("surname")); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("civility")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo ucfirst(text($user->get("civility"))); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("pseudo")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo $user->get("pseudo"); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("password")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo $user->get("password"); ?>
	</div>
	<div style="clear: left;">
	</div>
	
	<div style="float: left;width: 200px;padding: 15px;font-weight: bold;">
		<?php echo ucfirst(text("mail")); ?>
	</div>
	<div style="overflow: hidden;padding: 15px;">
		<?php echo $user->get("mail"); ?>
	</div>
	<div style="clear: left;">
	</div>
</div>