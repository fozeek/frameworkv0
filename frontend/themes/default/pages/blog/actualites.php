<!-- Actualités page -->


<div id="actualites-page">
    <!-- Actualités content -->
    <div class="middle-column">
	<div class="border-title">
	    <h1 class="middle-title">
		<?php echo NEWS_TITLE; ?>
	    </h1>
	</div>
	
	<div id="explanation-text-page">
	    <p><?php echo NEWS_TEXT; ?></p>
	</div>
	
	<div class="content-container" style="padding-top: 20px;">
	    <?php
		foreach($news as $new){
		    $url_image = get_url_image($new);
		    
		    include(_theme_path_ . "partials/bigNewsPreview.php");
		}
	    ?>
	    <div class="cl"></div>
	</div>
	
	<aside>
	    <!-- News -->
	    <div class="border-title">
		<h1 class="right-title"><?php echo ARTICLES_WORD; ?></h1>
	    </div>
	    
	    <div id="articles-box" class="aside-box">
		<?php
		    foreach($articles as $article) {
			include(_theme_path_ . "partials/articlesPreview.php");
		    }
		?>

		<div class="marginAuto">
		    <div class="button big-button">
			<span>
			    <a href="<?php echo Kernel::getUrl("blog/articles"); ?>"><?php echo SEE_ARTICLES; ?></a>
			</span>
		    </div>
		</div>
	    </div>
	</aside>
	<div class="cl"></div>
	
    </div>
</div>