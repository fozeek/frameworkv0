<!-- Tag page -->
<?php
    $nb_tag = count($tag_target->get("articles"));
?>
<div id="tag-page">
    <div class="middle-column">
	<div class="border-title">
	    <h1 class="left-title">
		<span class="black"><?php echo TAG . " :</span> " . $tag_target->get("name"); ?>
	    </h1>
	    <div class="cl"></div>
	</div>
	<div class="cl"></div>
	<div class="content-container" style="padding-top: 20px;">
	    <?php
		$articles_tag = $tag_target->get("articles");
		if(count($articles_tag) > 0){
		    foreach ($tag_target->get("articles") as $article){
			$url_image = get_url_image($article);

			include(_theme_path_ . "partials/bigArticlePreview.php");
		    }
		}
		else {
		    echo "<h2>" . NO_ARTICLE_CATEGORY . "</h2>";
		}
	    ?>
	</div>
	
	<aside>
	    <!-- Tags -->
	    <div class="border-title">
		<h1 class="right-title"><?php echo TAGS_WORD; ?></h1>
	    </div>
	    
	    <div id="news-box" class="aside-box">
		<?php
		    foreach($tags as $tag_temp) {
			if($tag_temp->get("name") == $tag_target->get("name"))
			    continue;
			
			$nb_articles = count($tag_temp->get("articles"));
		?>
			<a href="<?php echo Kernel::getUrl("blog/tag/" . $tag_temp->get("name")); ?>" class="article-tag">
			    <?php echo $tag_temp->get("name"); ?>
			    <span class="right"><?php echo $nb_articles; ?></span>
			</a>
		<?php
		    }
		?>

		<div class="marginAuto">
		    <div class="button big-button">
			<span>
			    <a href="<?php echo Kernel::getUrl("blog/tags");?>"><?php echo SEE_TAGS; ?></a>
			</span>
		    </div>
		</div>
	    </div>
	</aside>
	
	<div class="cl"></div>
    </div>
</div>