<!-- Category page -->


<div id="category-page">
    <!-- Category content -->
    <div class="middle-column">
	<div class="border-title">
	    <h1 class="middle-title">
		<?php echo CATEGORY_TUTOS . " " . $cat->get("name"); ?>
	    </h1>
	</div>
	
	<div id="explanation-text-page">
	    <p><?php echo $cat->get("description"); ?></p>
	</div>
	
	<div class="content-container" style="padding-top: 20px;">
	    <?php
		$articles_cat = $cat->get("articles");
		if(count($articles_cat) > 0){
		    foreach($articles_cat as $article){
			$url_image = get_url_image($article);

			include(_theme_path_ . "partials/bigArticlePreview.php");
		    }
		}
		else{
		    echo "<h2>" . NO_ARTICLE_CATEGORY . "</h2>";
		}
	    ?>
	    <div class="cl"></div>
	</div>
	
	<aside>
	    <?php 
		$nb_articles = $cat->get("articles")->count();
		$text_articles = ($nb_articles > 1 ? TUTOS : TUTO);
	    ?>
	    <!-- infos -->
	    <div class="border-title">
		<h1 class="right-title"><?php echo $cat->get("name"); ?></h1>
	    </div>
	    
	    <div id="info-box" class="aside-box">
		<?php 
		    $url_image = get_url_image($cat);
		?>
		<div class="image-container">
		    <img src="<?php echo $url_image;?>" alt="<?php echo ALT_CATEGORY_IMAGE . " " . $cat->get("name");?>" />
		</div>
		<h4>
		    <?php
			echo TUTOS_BY_CATEGORY . " " . $nb_articles . " " . $text_articles;
		    ?>
		</h4>
	    </div>
	</aside>
	<div class="cl"></div>
	
    </div>
</div>