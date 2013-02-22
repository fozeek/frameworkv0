<?php
    $urlArticle = Kernel::getUrl("blog/article/" . Kernel::sanitize($article->get("category")->get("name")) . "/" . Kernel::sanitize($article->get("title")));
?>

<div class="one-article">
    <div class="left" style="width: 339px; height: 216px;text-align: center;">
	<a href="<?php echo $urlArticle; ?>">
	    <img src="<?php echo $url_image; ?>" alt="<?php echo ALT_ARTICLE_IMAGE . " " . $article->get("title"); ?>" />
	</a>
    </div>

    
    <div class="left article-content">
	<h2><a href="<?php echo $urlArticle; ?>"><?php echo $article->get("title"); ?></a></h2>

	<p class="article-caption">
	    <span class="date"><?php echo THE . " " . format_date($article->get("date")) . " " . BY; ?></span>
	    <a href="<?php echo Kernel::getUrl("user/profil/" . $article->get("author")->get("pseudo")); ?>"><?php echo $article->get("author")->get("pseudo"); ?></a>
	</p>
	<p class="content-introduction">
	    <?php echo nl2br(short_description($article->get("text"), 144)); ?>
	</p>
	<div class="more-container">
	    <p class="show-more">
		[...] <a href="<?php echo $urlArticle; ?>"><?php echo SEE_MORE; ?></a>
	    </p>
	    <p class="comment">
		<a href="<?php echo $urlArticle; ?>#ancre-comments">
		    <img src="<?php echo '/'._theme_path_ . 'images/'; ?>bulle.png" alt="<?php echo ALT_SEE_COMMENTS; ?>" />
		    <?php 
			$nb_comment = $article->get("comments")->count();
			$text_comment = ($nb_comment > 1 ? COMMENTS : COMMENT);
			echo $nb_comment . " " . $text_comment;
		    ?>
		</a>
	    </p>
	</div>
    </div>
    <div class="cl"></div>

    
    <div class="article-category left">
	<img src="<?php echo '/'._theme_path_ . 'images/'; ?>angle.png" alt="<?php echo ALT_HEADBAND; ?>" />
	<?php 
		$temp = $article->get("category")->get("name");
		if(strlen($article->get("category")->get("name")) > 15){
		    $temp_array = explode(" ", $article->get("category")->get("name"));
		    $temp = implode("<br/>", $temp_array);
		}
	?>
	<a style="<?php echo (isset($temp_array) ? 'height:40px;padding-top:13px;margin-left:-8px;' : ''); ?>" class="aBlock" href="<?php echo Kernel::getUrl("blog/category/" . Kernel::sanitize($article->get("category")->get("name"))); ?>">
	    <?php 
		echo $temp; ?>
	</a>
    </div>

    
    <div class="article-tags left">
	<?php 
	    foreach($article->get("tags") as $tag) {
	?>
		<a href="<?php echo Kernel::getUrl("blog/tag/" . $tag->get("name")); ?>" class="article-tag">
		    <?php echo $tag->get("name"); ?>
		</a>
	<?php
	    }
	?>
    </div>
    <div class="cl"></div>
</div>