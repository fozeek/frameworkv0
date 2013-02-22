<header>
	<div id="top-header">
		<?php
		    if(Kernel::get("action") != "404" && 
		      (Kernel::get("action") != "compte" || 
		      (Kernel::get("action") == "compte" && !Kernel::get("session")->containsKey("first_connection")) ||
		      (Kernel::get("action") == "compte" && Kernel::get("session")->containsKey("first_connection") && !Kernel::get("session")->get("first_connection")))){
		?>
			<div id="oiseau-anime">
				<img src="<?php echo '/'._theme_path_ . 'images/'; ?>oeuil-oiseau.png" alt="<?php echo ALT_BIRD_EYE; ?>" class="bird-eye" id="left-eye"/>
				<img src="<?php echo '/'._theme_path_ . 'images/'; ?>oeuil-oiseau.png" alt="<?php echo ALT_BIRD_EYE; ?>" class="bird-eye" id="right-eye"/>
			</div>
		<?php
		    }
		?>
		<div id="login-box">
		    <?php
			if(Kernel::get("user") == false) {
		    ?>
			<a href="<?php echo Kernel::getUrl("user/connection"); ?>"><?php echo CONNECTION; ?></a>
			<span>&nbsp;/&nbsp;</span>
			<a href="<?php echo Kernel::getUrl("user/subscription"); ?>"><?php echo INSCRIPTION; ?></a>
		    <?php
			}
			else {
		    ?>
			<a href="<?php echo Kernel::getUrl("user/profil/" . Kernel::get("user")->get("pseudo")); ?>">
				<img src="<?php echo '/'._theme_path_ . 'images/'; ?>membership.png" alt="<?php echo ALT_MY_PROFILE; ?>" />
				<?php echo MY_PROFILE; ?>
			</a>
			<span>&nbsp;-&nbsp;</span>
			<a href="<?php echo Kernel::getUrl("user/compte"); ?>">
				<?php echo MY_ACCOUNT; ?>
			</a>
			<span>&nbsp;-&nbsp;</span>
			<a href="<?php echo Kernel::getUrl("user/disconnect"); ?>">
				<?php echo DECONNECTION; ?>
			</a>
		    <?php
			}
		    ?>
		</div>
		<div class="right search-flag-container">
			<div id="flag-box">
				<?php 
					if(empty($link)) {
						$link["fr"] = Kernel::getUrl("fr/".Kernel::get("url"));
						$link["en"] = Kernel::getUrl("en/".Kernel::get("url"));
					}
				?>
			    <a href="<?php echo $link["fr"];?>">
					<img src="<?php echo '/'._theme_path_ . 'images/'; ?>flag_fr.png" alt="<?php echo ALT_TRANSLATE_FR; ?>" />
					<span class="flag-caption">FR</span>
				</a>
			    <a href="<?php echo $link["en"];?>">
					<img src="<?php echo '/'._theme_path_ . 'images/'; ?>/flag_en.png" alt="<?php echo ALT_TRANSLATE_EN; ?>" />
					<span class="flag-caption">EN</span>
				</a>
			</div>
			
			<div id="search-box">
				<span><?php echo QUICK_SEARCH; ?> :</span>
				<input type="text" value="" class="input-template" placeholder="<?php echo PL_SEARCH; ?>" />
				<input type="submit" value="" class="button-search" />
			</div>
		</div>
		
		<div class="cl"></div>
	</div>
	
	<nav>
		<ul id="left-nav">
			<li><a href="<?php echo Kernel::getUrl(""); ?>"><?php echo HOME; ?></a></li>
			<li><a href="<?php echo Kernel::getUrl("blog/categories"); ?>"><?php echo CATEGORY; ?></a></li>
			<li><a href="<?php echo Kernel::getUrl("blog/articles"); ?>"><?php echo ARTICLE; ?></a></li>			
		</ul>
		
		<div id="logo">
			<a href="<?php echo Kernel::getUrl(""); ?>">
				<img src="<?php echo '/'._theme_path_ . 'images/'; ?>logo.png" alt="<?php echo ALT_LOGO; ?>" />
			</a>
		</div>
		
		<ul id="right-nav">
			<li><a href="<?php echo Kernel::getUrl("blog/actualites"); ?>"><?php echo NEWS; ?></a></li>
			<li><a href="#"><?php echo SEARCH; ?></a></li>
			<li><a href="<?php echo Kernel::getUrl("page/contact"); ?>"><?php echo CONTACT; ?></a></li>			
		</ul>
	</nav>
</header>