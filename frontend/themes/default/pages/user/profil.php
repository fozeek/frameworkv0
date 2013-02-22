<div id="profil-page">
<!-- profil content -->
    <div class="middle-column">
	<div class="border-title border-big-title">
		<h1 class="left-title big-title">
		    <?php echo WELCOME_PROFIL . " " . ucfirst($user->get("pseudo")); ?>
		</h1>
	    <div class="cl"></div>
	</div>
	
	<div class="informations-major-container">
	    <h2><?php echo IDENTITY; ?></h2>
	    <?php
		$default_image = '/' . _theme_path_ . 'images/' . 'article-image.png';
		if($image == "IN_USER")
		    $url_img = get_url_image($user);
		else
		    $url_img = 'http://www.gravatar.com/avatar/' . $image . '?d=' . urlencode('http://' . $_SERVER['HTTP_HOST'] . $default_image);
	    ?>
	    <img src="<?php echo $url_img; ?>" alt="<?php echo AVATAR . " " . ucfirst($user->get("name")) . " " . ucfirst($user->get("surname"));?>" width="80px" height="80px"/>
	    
	    <div class="pContainer">
		<label class="label-presentation"><?php echo RECOGNIZE_HIM . " :";?></label><p> <?php echo ucfirst($user->get("name")) . " " . ucfirst($user->get("surname")); ?></p>
		<label class="label-presentation"><?php echo CONTACT_HIM . " :";?></label><p> <?php echo $user->get("mail"); ?></p>
		<label class="label-presentation"><?php echo DATE_SIGNIN . " :";?></label><p> <?php echo format_date($user->get("datesignin")); ?></p>
	    </div>
	    
	    <div class="cl"></div>
	</div>
	<div class="informations-minor-container">
	     <h2><?php echo MORE_ABOUT_HIM . " " . ucfirst($user->get("name"));?></h2>
	     
	    <div class="pContainer">
		<label class="label-presentation"><?php echo FIND_HIM . " :";?></label><p> <?php echo ucfirst($user->get("city")) . " " . IN . " " . ucfirst($user->get("country")); ?></p>
		<label class="label-presentation"><?php echo SEE_WORK . " :";?></label><p><a target="_BLANK" href="<?php echo $user->get("site"); ?>"><?php echo $user->get("site"); ?></a></p>
		<label class="label-presentation"><?php echo WHAT_HE_DO . " :";?></label><p> <?php echo str_replace(",", ", ",$user->get("languages")); ?></p>
	    </div>
	    
	    <div class="cl"></div>
	</div>
	
	<div class="cl"></div>
    </div>
</div>