<div id="connection-page">
<!-- connection content -->
    <div class="middle-column">
	<div class="border-big-title">
		<h1 class="left-title big-title">
		    <?php echo CONNECTION_TITLE; ?>
		</h1>
	    <div class="cl"></div>
	</div>
	
	<div id="explanation-text-page">
	    <p><?php echo CONNECTION_TEXT; ?></p>
	    <p style="text-decoration: underline;"><a href="<?php echo Kernel::getUrl("user/subscription"); ?>"><?php echo NOT_SUBSCRIBER; ?></a></p>
	</div>
	
	<form action="" method="post" id="login-form" >
	    <label class="label"><?php echo LBL_PSEUDO;?></label>
	    <input type="text" name="pseudo" id="pseudo" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["pseudo"] : ''); ?>" placeholder="<?php echo PL_PSEUDO; ?>"  />

	    <div class="cl"></div>
	    <span class="tooltip" <?php echo (isset($error["pseudo"]) ? 'style="display: block;"' : ''); ?>><?php echo SIX_CHAR_MIN; ?></span>
		
	    <label class="label"><?php echo LBL_PASSWORD; ?> :</label>
	    <input type="password" name="password" value="" id="password1" placeholder="<?php echo PL_PASSWORD; ?>"  />

	    <div class="cl"></div>
	    <span class="tooltip" <?php echo (isset($error["password"]) ? 'style="display: block;"' : ''); ?>><?php echo SIX_CHAR_MIN; ?></span>
	    
	    <div class="main-tooltip" <?php echo (isset($error["bad_login"]) ? 'style="display: block;"' : ''); ?>><?php echo BAD_LOGIN; ?></div> 
	    
	    <div class="marginAuto">
		<div class="button big-button">
		    <span>
			<input type="submit" value="<?php echo LOGIN; ?>" />
		    </span>
		</div>
	    </div>
	</form>
    </div>
</div>