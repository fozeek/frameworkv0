<!-- Categories page -->

<div id="categories-page">
    <!-- Categories content -->
    <div class="middle-column">
	<div class="border-title">
	    <h1 class="middle-title">
		<?php echo CATEGORIES_TITLE; ?>
	    </h1>
	</div>
	
	<div id="explanation-text-page">
	    <p><?php echo CATEGORIES_TEXT; ?></p>
	</div>
	
	<?php
	    $cpt_cat = 0;
	    foreach($cats as $cat){
		$url_image = get_url_image($cat);
		$urlCategory = Kernel::getUrl("blog/category/" . Kernel::sanitize($cat->get("name")));
		$tutos_category = $cat->get("articles")->count();
	?>
		<div class="one-article minSize <?php echo ($cpt_cat % 2 == 0 ? "no-margin" : ""); ?>">
		    <div class="left" style="width: 90px; height: 80px; margin: 10px 0 0 10px;text-align: center;">
			<img src="<?php echo $url_image; ?>" alt="<?php echo ALT_CATEGORY_IMAGE . " " . $cat->get("name"); ?>" />
		    </div>

		    <div class="left article-content">
			<h2><?php echo $cat->get("name"); ?></h2>
			<p class="content-introduction">
			    <?php
				echo short_description($cat->get("description"));
			    ?>
			</p>
			<div class="more-container">
			    <p class="show-more">[...] <a href="#"><?php echo SEE_TUTO; ?></a>
			    </p>
			</div>
		    </div>
		    <div class="cl"></div>

		    <div class="article-category left">
			<img src="<?php echo '/'._theme_path_ . 'images/'; ?>angle.png" alt="<?php echo ALT_HEADBAND; ?>" />
			<a class="aBlock" href="<?php echo $urlCategory;?>">
			    <?php echo $tutos_category; ?> <?php echo ($tutos_category > 1 ? TUTOS : TUTO); ?>
			</a>
		    </div>
		    <div class="cl"></div>

		    <div class="hover-article">
			<a style="display:block; width: 100%;height: 100%;" href="<?php echo $urlCategory; ?>">
			</a>
			<a href="<?php echo $urlCategory ?>">
			    <div class="left-hover">
				<p><?php echo LEFT_PRINT_CATEGORY; ?></p>
			    </div>
			    <div class="right-hover">
				<p><?php echo RIGHT_PRINT_CATEGORY; ?></p>
			    </div>
			</a>
		    </div>
		</div>
	<?php
		$cpt_cat++;
	    }
	?>
	<div class="cl"></div>
    </div>
</div>