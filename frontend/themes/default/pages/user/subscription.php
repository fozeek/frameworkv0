<div id="subscription-page">
<!-- Subscription content -->
    <div class="middle-column">
	<div class="border-big-title">
		<h1 class="left-title big-title">
		    <?php echo SUBSCRIPTION_TITLE; ?>
		</h1>
	    <div class="cl"></div>
	</div>
	
	<div id="explanation-text-page">
	    <p><?php echo SUBSCRIPTION_TEXT; ?></p>
	</div>
	
	<form action="" method="post" id="register-form">
	    <div class="left-column">
		<div class="border-title">
		    <h2 class="left-title">
			<?php echo MANDATORY_INFORMATIONS; ?>
		    </h2>
		</div>
		
		<label class="label"><?php echo LBL_CIVILITE; ?> :</label>
		<input type="radio" checked="checked" name="civilite" id="man-civilite" value="homme" /><label for="man-civilite" class="box-next"><?php echo LBL_MAN; ?></label>
		<input type="radio" name="civilite" id="woman-civilite" value="femme" /><label for="woman-civilite" class="box-next"><?php echo LBL_WOMAN; ?></label>

		<div class="cl"></div>
		
		<label class="label"><?php echo LBL_NAME; ?> :</label>
		<input type="text" name="firstname" id="firstname" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["surname"] : ''); ?>" placeholder="<?php echo PL_NAME; ?>" required/>

		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["surname"]) ? 'style="display: block;"' : ''); ?>><?php echo REQUIRED_FIELD; ?></span>

		<label class="label"><?php echo LBL_FIRSTNAME; ?> :</label>
		<input type="text" name="name" id="name" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["name"] : ''); ?>" placeholder="<?php echo PL_FIRSTNAME; ?>"  required/>

		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["name"]) ? 'style="display: block;"' : ''); ?>><?php echo REQUIRED_FIELD; ?></span>
		
		<label class="label"><?php echo LBL_PSEUDO; ?> :</label>
		<input type="text" name="pseudo" id="pseudo" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["pseudo"] : ''); ?>" placeholder="<?php echo PL_PSEUDO; ?>"  required/>

		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["pseudo"]) ? 'style="display: block;"' : ''); ?>><?php echo SIX_CHAR_MIN; ?></span>
		<span class="main-tooltip" <?php echo (isset($error["pseudo_exist"]) ? 'style="display: block;"' : ''); ?>><?php echo ALREADY_EXIST; ?></span>

		<label class="label"><?php echo LBL_PASSWORD; ?> :</label>
		<input type="password" name="password" value="" id="password1" placeholder="<?php echo PL_PASSWORD; ?>"  required/>

		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["password"]) ? 'style="display: block;"' : ''); ?>><?php echo SIX_CHAR_MIN; ?></span>
		
		<label class="label"><?php echo LBL_CONFIRM_PASSWORD; ?> :</label>
		<input type="password" name="confirm_password" value="" id="password2" placeholder="<?php echo PL_CONFIRM_PASSWORD; ?>"  required/>

		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["password"]) ? 'style="display: block;"' : ''); ?>><?php echo WRONG_CONFIRM_PWD; ?></span>
		
		<label class="label"><?php echo LBL_EMAIL; ?>* :</label>
		<input type="text" name="email" id="email" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["mail"] : ''); ?>" placeholder="<?php echo PL_EMAIL; ?>" pattern="[a-zA-Z0-9\-\_\.]+@[a-zA-Z0-9\-\_\.]+\.[a-zA-Z]+"  required/>
		
		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["mail"]) ? 'style="display: block;"' : ''); ?>><?php echo WRONG_PATTERN_EMAIL; ?></span>
		
	    </div>

	    <div class="right-column">
		<div class="border-title">
		    <h2 class="left-title">
			<?php echo OPTIONAL_INFORMATIONS; ?>
		    </h2>
		</div>

		<label class="label"><?php echo LBL_PAYS; ?> :</label>
		<select name="pays">
		    <option>France</option>
		</select>

		<div class="cl"></div>

		<label class="label"><?php echo LBL_VILLE; ?> :</label>
		<input type="text" name="city" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["city"] : ''); ?>" placeholder="<?php echo PL_VILLE; ?>" />
		
		<div class="cl"></div>
		
		<label class="label"><?php echo LBL_SITE; ?> :</label>
		<input type="text" name="site" id="site" value="<?php echo ((isset($error) && count($error) > 0) ? $attr["site"] : ''); ?>" placeholder="<?php echo PL_SITE; ?>" pattern="((http:\/\/|https:\/\/)(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)"/>

		<div class="cl"></div>
		<span class="tooltip" <?php echo (isset($error["site"]) ? 'style="display: block;"' : ''); ?>><?php echo WRONG_PATTERN_URL; ?></span>

		<label class="label"><?php echo LBL_LANGAGE; ?> :</label>
		<input type="checkbox" name="langage-php" value="php" id="langage-php" class="check-langage"/>
		<label for="langage-php" class="box-next">&nbsp; PHP</label>
		
		<input type="checkbox" name="langage-html" value="html" id="langage-html" class="check-langage"/>
		<label for="langage-html" class="box-next">&nbsp; HTML</label>
		
		<input type="checkbox" name="langage-css" value="css" id="langage-css" class="check-langage"/>
		<label for="langage-css" class="box-next">&nbsp; CSS</label>
		
		<input type="checkbox" name="langage-csharp" value="csharp" id="langage-csharp" class="check-langage"/>
		<label for="langage-csharp" class="box-next">&nbsp; C#</label>
		
		<div class="cl"></div>
		<label class="label"></label>
		<input type="checkbox" name="langage-asp" value="asp" id="langage-asp" class="check-langage"/>
		<label for="langage-asp" class="box-next">&nbsp; ASP.NET</label>
		
		<input type="checkbox" name="langage-javascript" value="javascript" id="langage-javascript" class="check-langage"/>
		<label for="langage-javascript" class="box-next">&nbsp; Javascript</label>
		
		<input type="checkbox" name="langage-jquery" value="jquery" id="langage-jquery" class="check-langage"/>
		<label for="langage-jquery" class="box-next">&nbsp; JQuery</label>

		<input type="hidden" name="langage" value="" id="hidden-langage"/>
		<div class="cl"></div>
	    </div>
	    
	    <div class="cl"></div>
	    
	    <h4>*<?php echo IF_HAVE_ACCOUNT; ?> <a target="_blank" href="http://fr.gravatar.com">gravatar</a>, <?php echo USE_IT; ?></h4>
	    <div class="marginAuto">
		<div class="button big-button">
		    <span>
			<input type="submit" value="<?php echo SUBSCRIBE; ?>" />
		    </span>
		</div>
	    </div>
	</form>
	
    </div>
</div>

<script type="text/javascript" src="<?php echo _host_absolute_ . _theme_path_ ?>js/formulaire.js"></script>
