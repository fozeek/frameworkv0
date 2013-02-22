<!-- Articles page -->


<div id="articles-page">
    <!-- Categories content -->
    <div class="middle-column">
	<div class="border-title">
	    <h1 class="middle-title">
		<?php echo ARTICLES_TITLE; ?>
	    </h1>
	</div>
	
	<div id="explanation-text-page">
	    <p><?php echo ARTICLES_TEXT; ?></p>
	</div>
	
	<div class="content-container" style="padding-top: 20px;">
	    <?php
		foreach($articles as $article){
		    $url_image = get_url_image($article);
		    
		    include(_theme_path_ . "partials/bigArticlePreview.php");
		}
	    ?>
	    <div class="cl"></div>
	</div>
	
	<aside>
	    <!-- News -->
	    <div class="border-title">
		<h1 class="right-title"><?php echo NEWS_WORD; ?></h1>
	    </div>
	    
	    <div id="news-box" class="aside-box">
		<?php
		    foreach($news as $new) {
			include(_theme_path_ . "partials/newsPreview.php");
		    }
		?>

		<div class="marginAuto">
		    <div class="button big-button">
			<span>
			    <a href="<?php echo Kernel::getUrl("blog/actualites");?>"><?php echo SEE_NEWS; ?></a>
			</span>
		    </div>
		</div>
	    </div>
	</aside>
	<div class="cl"></div>
	
    </div>
</div>