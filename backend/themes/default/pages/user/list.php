<?php partial("user_header"); ?>
<div style="padding: 20px;margin-top: -1px;border: 1px solid #E5E5E5;border-right: none;min-height: 500px;background: white;">
	<div style="padding-bottom: 10px;border-bottom: 1px solid #E5E5E5;">
		<div style="font-size: 1.6em;float: left;">
			<?php echo ucfirst(text("users")); ?>
		</div>
		<div style="overflow: hidden;padding-top:10px;padding-left: 20px;">
			<a href="<?php echo createLink("/user/add"); ?>" style="display: inline-block;padding-right: 5px;padding-left: 5px;"><?php echo ucfirst(text("add_a_user")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>

	<?php foreach ($users as $user) : ?>
	<div style="border-bottom: 1px solid #E5E5E5;padding: 15px;">	
		<div style="float: left;width: 200px;">
			<a href="<?php echo createLink("/user/show/".$user->get("id")); ?>"><?php echo lang($user->get("pseudo")); ?></a>
		</div>
		<div style="clear: both;">
		</div>
	</div>
	<?php endforeach; ?>

</div>